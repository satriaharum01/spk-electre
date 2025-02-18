<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Penilaian;

class MahasiswaRangkingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->data['title'] = 'Data Hasil Perhitungan';
        $this->data[ 'link' ] = '/mahasiswa/hasil';
        $this->page = 'mahasiswa/hasil';
        $this->view = 'mahasiswa/hasil/index';
        $this->data['page'] = $this->page;
    }

    public function index()
    {
        $this->data['sub_title'] = 'List Hasil Perhitungan Electre';

        return view('mahasiswa/hasil/index', $this->data);
    }

    public function json($p1 = null)
    {
        $alternatif = DB::table('alternatif')->get();
        $kriteria = DB::table('kriteria')->get();
        $nilai = DB::table('penilaian')->get();

        if ($nilai->isEmpty()) {
            return response()->json(['kosong' => true]);
        }

        $matrix = $nilai->groupBy('id')->mapWithKeys(fn ($item) => [
            $item->first()->id => $item->pluck('nilai', 'id_kriteria')
        ]);

        $x = $kriteria->mapWithKeys(fn ($k) => [
            $k->id => sqrt($alternatif->sum(fn ($a) => pow($matrix[$a->id][$k->id] ?? 0, 2)))
        ]);

        $matrixV = $alternatif->mapWithKeys(fn ($a) => [
            $a->id => $kriteria->mapWithKeys(fn ($k) => [
                $k->id => round(($matrix[$a->id][$k->id] ?? 0) / ($x[$k->id] ?: 1) * $k->bobot, 3)
            ])
        ]);

        $c = $alternatif->mapWithKeys(fn ($a) => [
            $a->id => $alternatif->mapWithKeys(fn ($b) => [
                $b->id => $kriteria->filter(fn ($k) => ($matrixV[$a->id][$k->id] ?? 0) >= ($matrixV[$b->id][$k->id] ?? 0))->keys()
            ])
        ]);

        $bobotKriteria = DB::table('kriteria')->pluck('bobot', 'id');
        $matrixC = $c->mapWithKeys(fn ($a, $i) => [
            $i => $a->mapWithKeys(fn ($b, $j) => [$j => $b->sum(fn ($k) => $bobotKriteria[$k] ?? 0)])
        ]);

        $thresholdC = $matrixC->flatten()->sum() / ($alternatif->count() * ($alternatif->count() - 1));

        $matrixF = $matrixC->mapWithKeys(fn ($a, $i) => [
            $i => $a->mapWithKeys(fn ($b, $j) => [$j => $b >= $thresholdC ? 1 : 0])
        ]);

        $rankedData  = $alternatif->map(fn ($a) => [
            'id' => $a->id,
            'kode' => $a->kode,
            'nama' => $a->nama,
            'total_nilai' => round($matrixV[$a->id]->avg(), 3),
            'agregate' => $alternatif->sum(fn ($b) => $matrixF[$a->id][$b->id] ?? 0)
        ])->sortByDesc(['agregate', 'total_nilai'])->values();

        $rankedData = $rankedData->map(fn ($item, $index) => array_merge($item, ['rank' => $index + 1]));

        return Datatables::of($rankedData)->addIndexColumn()->make(true);
    }

    public function hitungElectre()
    {
        // 1. Mengambil data alternatif, kriteria, dan nilai dari database
        $alternatif = DB::table('alternatif')->get();
        $kriteria = DB::table('kriteria')->get();
        $nilai = DB::table('penilaian')->get();

        // 2. Jika tidak ada data nilai, kembalikan response kosong
        if ($nilai->isEmpty()) {
            return response()->json(['kosong' => true]);
        }

        // 3. Membentuk Matrix Keputusan
        $matrix = $nilai->groupBy('id')->mapWithKeys(fn ($item) => [
            $item->first()->id => $item->pluck('nilai', 'id_kriteria')
        ]);

        // 4. Normalisasi Matrix dengan metode Vector
        $x = $kriteria->mapWithKeys(fn ($k) => [
            $k->id => sqrt($alternatif->sum(fn ($a) => pow($matrix[$a->id][$k->id] ?? 0, 2)))
        ]);

        // 5. Menghitung Matrix Normalisasi Ternormalisasi (V) dengan bobot kriteria
        $matrixV = $alternatif->mapWithKeys(fn ($a) => [
            $a->id => $kriteria->mapWithKeys(fn ($k) => [
                $k->id => round(($matrix[$a->id][$k->id] ?? 0) / ($x[$k->id] ?: 1) * $k->bobot, 3)
            ])
        ]);

        // 6. Membentuk Matrix Concordance (C)
        $c = $alternatif->mapWithKeys(fn ($a) => [
            $a->id => $alternatif->mapWithKeys(fn ($b) => [
                $b->id => $kriteria->filter(fn ($k) => ($matrixV[$a->id][$k->id] ?? 0) >= ($matrixV[$b->id][$k->id] ?? 0))->keys()
            ])
        ]);

        // 7. Menghitung Bobot Kriteria untuk Concordance
        $bobotKriteria = DB::table('kriteria')->pluck('bobot', 'id');
        $matrixC = $c->mapWithKeys(fn ($a, $i) => [
            $i => $a->mapWithKeys(fn ($b, $j) => [$j => $b->sum(fn ($k) => $bobotKriteria[$k] ?? 0)])
        ]);

        // 8. Menentukan Threshold Concordance (Ambang Batas)
        $thresholdC = $matrixC->flatten()->sum() / ($alternatif->count() * ($alternatif->count() - 1));

        // 9. Membentuk Matrix Dominasi (F)
        $matrixF = $matrixC->mapWithKeys(fn ($a, $i) => [
            $i => $a->mapWithKeys(fn ($b, $j) => [$j => $b >= $thresholdC ? 1 : 0])
        ]);

        // 10. Menghitung Total Agregate untuk Setiap Alternatif
        $rankedData = $alternatif->map(fn ($a) => [
            'id' => $a->id,
            'kode' => $a->kode,  // Tambahkan kode alternatif
            'nama' => $a->nama,  // Tambahkan nama alternatif
            'total_nilai' => round($matrixV[$a->id]->avg(), 3), // Rata-rata nilai alternatif
            'agregate' => $alternatif->sum(fn ($b) => $matrixF[$a->id][$b->id] ?? 0) // Jumlah dominasi
        ]);

        // 11. Menghindari Kasus Semua Agregate 0 dengan Equivalent Consistency
        $isAllZero = $rankedData->every(fn ($item) => $item['agregate'] == 0);

        // 12. Melakukan Sorting dengan fallback ke total_nilai jika semua agregate bernilai 0
        $rankedData = $rankedData->sortByDesc(fn ($item) => $isAllZero ? $item['total_nilai'] : [$item['agregate'], $item['total_nilai']])->values();

        // 13. Menambahkan Ranking yang berurutan (1 sampai jumlah alternatif)
        $rankedData = $rankedData->map(function ($item, $index) {
            $item['rank'] = $index + 1;
            return $item;
        });

        // 14. Mengembalikan data dalam bentuk JSON DataTables
        return Datatables::of($rankedData)
            ->addIndexColumn()
            ->make(true);
    }

    public function hitungElectreCI($p1 = "")
    {
        $metode = new MetodeModel();
        $alternatifModel = new AlternatifModel();

        $alternatif = $metode->getAlternatif();
        $nilai = $metode->getAlternatifNilai(Request::get('p'));

        if ($nilai->isEmpty()) {
            return ['kosong' => true];
        }

        $kriteria = $metode->getKriteria();

        // Matrix keputusan
        $matrix = [];
        foreach ($nilai as $v) {
            $matrix[$v->id][$v->id_kriteria] = $v->nilai;
        }

        // Menjumlahkan nilai kriteria alternatif setiap kriteria
        $x = [];
        foreach ($kriteria as $val) {
            $temp = 0;
            foreach ($alternatif as $v) {
                $temp += pow($matrix[$v->id][$val->id], 2);
            }
            $x[$val->id] = round(sqrt($temp), 3);
        }

        // Normalisasi & Pembobotan
        $matrix_r = [];
        $matrix_v = [];
        foreach ($kriteria as $key => $val) {
            foreach ($alternatif as $k => $v) {
                $matrix_r[$v->id][$val->id] = round($matrix[$v->id][$val->id] / $x[$val->id], 3);
                $matrix_v[$k + 1][$key + 1] = number_format(round($matrix_r[$v->id][$val->id] * $val->bobot, 3), 3);
            }
        }

        // Menentukan Concordance & Discordance Sets
        $c = [];
        $d = [];
        for ($i = 1; $i <= count($alternatif); $i++) {
            for ($j = 1; $j <= count($alternatif); $j++) {
                $c[$i][$j] = [];
                $d[$i][$j] = [];
                foreach ($kriteria as $k => $v) {
                    if ($i == $j) {
                        $c[$i][$j][] = "-";
                        $d[$i][$j][] = "-";
                    } else {
                        if ($matrix_v[$i][$k + 1] >= $matrix_v[$j][$k + 1]) {
                            $c[$i][$j][] = $k;
                        } else {
                            $d[$i][$j][] = $k;
                        }
                    }
                }
            }
        }

        // Perhitungan matrix Concordance & Discordance
        $bobot = $metode->getBobotKriteria();
        $matrix_c = [];
        foreach ($c as $key => $value) {
            foreach ($value as $k => $val) {
                $temp = 0;
                foreach ($val as $v) {
                    if ($key != $k) {
                        $temp += $bobot[$v]->bobot;
                    }
                }
                $matrix_c[$key][$k] = $temp;
            }
        }

        // Perhitungan Threshold Concordance
        $threshold_c = array_sum(array_map('array_sum', $matrix_c)) / (count($alternatif) * (count($alternatif) - 1));

        // Menentukan Matrix Threshold Concordance & Discordance
        $matrix_f = [];
        foreach ($matrix_c as $key => $value) {
            foreach ($value as $k => $val) {
                $matrix_f[$key][$k] = ($key != $k && $val >= $threshold_c) ? 1 : 0;
            }
        }

        // Menghitung agregat dominan matrix
        $matrix_e = [];
        for ($i = 1; $i <= count($alternatif); $i++) {
            for ($j = 1; $j <= count($alternatif); $j++) {
                $matrix_e[$i][$j] = ($i != $j) ? $matrix_f[$i][$j] : "-";
            }
        }

        // Hasil Ranking
        $rank = [];
        foreach ($alternatif as $k => $p) {
            $data = ['total_nilai' => array_sum($matrix_v[$k + 1]) / count($kriteria)];
            $alternatifModel->updateRank($data, $p->id);
            $rank[] = $p;
        }

        foreach ($rank as $i => $p) {
            $rank[$i]->agregate = 0;
            for ($j = 0; $j < count($alternatif); $j++) {
                if ($i != $j) {
                    $rank[$i]->agregate += $matrix_f[$i + 1][$j + 1];
                }
            }
        }

        usort($rank, function ($a, $b) {
            return $b->agregate <=> $a->agregate ?: $b->total_nilai <=> $a->total_nilai;
        });

        if ($p1 == "report") {
            return [
                'kosong' => false,
                'report' => $matrix_e
            ];
        }

        return [
            'kosong' => false,
            'alternatif' => $alternatif,
            'nilai' => $nilai,
            'kriteria' => $kriteria,
            'matrix' => $matrix,
            'x' => $x,
            'matrix_r' => $matrix_r,
            'matrix_v' => $matrix_v,
            'c' => $c,
            'd' => $d,
            'matrix_c' => $matrix_c,
            'matrix_f' => $matrix_f,
            'matrix_e' => $matrix_e,
            'rank' => $rank
        ];
    }

    public function hitungElectreLaravel()
    {
        $alternatif = Alternatif::all();
        $kriteria = Kriteria::all();
        $penilaian = Penilaian::all();

        if ($penilaian->isEmpty()) {
            return ['kosong' => true];
        }

        // Matrix Keputusan
        $matrix = [];
        foreach ($penilaian as $nilai) {
            $matrix[$nilai->id_alternatif][$nilai->id_kriteria] = $nilai->nilai;
        }

        // Normalisasi Matrix
        $x = [];
        foreach ($kriteria as $k) {
            $sum = 0;
            foreach ($alternatif as $a) {
                $sum += pow($matrix[$a->id][$k->id] ?? 0, 2);
            }
            $x[$k->id] = sqrt($sum);
        }

        // Matrix Ternormalisasi dan Pembobotan
        $matrixR = [];
        $matrixV = [];
        foreach ($kriteria as $k) {
            foreach ($alternatif as $a) {
                $matrixR[$a->id][$k->id] = ($matrix[$a->id][$k->id] ?? 0) / $x[$k->id];
                $matrixV[$a->id][$k->id] = round($matrixR[$a->id][$k->id] * $k->bobot, 3);
            }
        }

        // Concordance & Discordance Sets
        $c = [];
        $d = [];
        foreach ($alternatif as $i) {
            foreach ($alternatif as $j) {
                if ($i->id != $j->id) {
                    $c[$i->id][$j->id] = [];
                    $d[$i->id][$j->id] = [];
                    foreach ($kriteria as $k) {
                        if ($matrixV[$i->id][$k->id] >= $matrixV[$j->id][$k->id]) {
                            $c[$i->id][$j->id][] = $k->id;
                        } else {
                            $d[$i->id][$j->id][] = $k->id;
                        }
                    }
                }
            }
        }

        // Concordance Matrix
        $matrixC = [];
        foreach ($c as $i => $values) {
            foreach ($values as $j => $criteriaIds) {
                $matrixC[$i][$j] = array_sum(array_map(fn ($id) => Kriteria::find($id)->bobot, $criteriaIds));
            }
        }

        $criteriaIds = Kriteria::pluck('id')->toArray();

        if (empty($criteriaIds)) {
            throw new Exception('Tidak ada kriteria yang ditemukan.');
        }

        // Ambil semua kriteria sebagai array asosiatif
        $kriteriaArray = Kriteria::all()->map(fn ($k) => ['id' => $k->id])->toArray();

        // Discordance Matrix
        $matrixD = [];
        foreach ($d as $i => $values) {
            foreach ($values as $j => $value) {
                // Hitung perbedaan untuk kriteria yang valid
                $differences = array_map(fn ($id) => abs($matrixV[$i][$id] - $matrixV[$j][$id]), $criteriaIds);
                $maxDiff = !empty($differences) ? max($differences) : 0;

                // Hitung max dari semua kriteria menggunakan array hasil mapping
                $maxAll = max(array_map(fn ($k) => abs($matrixV[$i][$k['id']] - $matrixV[$j][$k['id']]), $kriteriaArray));

                // Hindari pembagian dengan nol
                $matrixD[$i][$j] = $maxAll > 0 ? round($maxDiff / $maxAll, 3) : 0;
            }
        }

        // Thresholds
        $thresholdC = array_sum(array_merge(...array_values($matrixC))) / (count($alternatif) * (count($alternatif) - 1));
        $thresholdD = array_sum(array_merge(...array_values($matrixD))) / (count($alternatif) * (count($alternatif) - 1));

        // Matrix Dominan
        $matrixF = array_map(fn ($row) => array_map(fn ($val) => $val >= $thresholdC ? 1 : 0, $row), $matrixC);
        $matrixG = array_map(fn ($row) => array_map(fn ($val) => $val >= $thresholdD ? 1 : 0, $row), $matrixD);

        // Agregat Dominan Matrix
        $matrixE = [];
        foreach ($alternatif as $i) {
            foreach ($alternatif as $j) {
                if ($i->id != $j->id) {
                    $matrixE[$i->id][$j->id] = $matrixF[$i->id][$j->id] * $matrixG[$i->id][$j->id];
                }
            }
        }

        // Ranking
        $ranking = [];
        foreach ($alternatif as $a) {
            $totalNilai = array_sum($matrixV[$a->id]) / count($kriteria);
            $agregate = array_sum($matrixE[$a->id] ?? []);
            $ranking[] = [
                'nama' => $a->nama,
                'kode' => $a->kode,
                'total_nilai' => number_format($totalNilai, 3),
                'agregate' => $agregate
            ];
        }

        usort($ranking, fn ($a, $b) => $b['agregate'] <=> $a['agregate'] ?: $b['total_nilai'] <=> $a['total_nilai']);

        // Tambahkan rank
        foreach ($ranking as $index => &$r) {
            $r['rank'] = $index + 1;
        }

        // Urutkan kembali berdasarkan kode alternatif
        usort($ranking, fn ($a, $b) => $a['kode'] <=> $b['kode']);
        
        return Datatables::of($ranking)
        ->addIndexColumn()
        ->make(true);
    }
}
