<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Notif;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public $bulan = array('','Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
    public $hari = [
        "","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu"
    ];

    public $klasifikasi = array('A','B','C');


    public function profile_destroy($filename)
    {
        if (File::exists(public_path('/assets/img/faces/' . $filename . ''))) {
            File::delete(public_path('/assets/img/faces/' . $filename . ''));
        }
    }
    
    public function buat_notif($title, $icon, $color)
    {
        $data = [
            'judul' => $title,
            'status' => 'wait',
            'icon' => $icon,
            'color' => $color,
            'id_user' => Auth::user()->id
        ];

        Notif::create($data);
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

        //usort($ranking, fn ($a, $b) => $b['agregate'] <=> $a['agregate'] ?: $b['total_nilai'] <=> $a['total_nilai']);

        usort($ranking, fn ($a, $b) => $b['total_nilai'] <=> $a['total_nilai']);

        // Tambahkan rank
        foreach ($ranking as $index => &$r) {
            $r['rank'] = $index + 1;
        }

        // Urutkan kembali berdasarkan kode alternatif
        usort($ranking, fn ($a, $b) => $a['kode'] <=> $b['kode']);
        
        return $ranking;
    }
}
