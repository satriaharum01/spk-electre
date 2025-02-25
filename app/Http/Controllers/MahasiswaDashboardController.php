<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class MahasiswaDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_mahasiswa');
        //$this->middleware('is_mahasiswa');
    }

    /*
     * Dashboad Function
    */
    public function index()
    {
        $this->data['title'] = 'Dashboard mahasiswa';
        $this->data['c_alternatif'] = $this->countAlternatif();
        $this->data['c_kriteria'] = $this->countKriteria();
        $this->data['c_max'] = $this->maxValueElectre();
        $this->data['c_min'] = $this->minValueElectre();

        $this->data['chart'] = $this->hitungElectreLaravel();
        return view('mahasiswa/dashboard/index', $this->data);
    }



    //COUNTERS
    public function countAlternatif()
    {
        $data = Alternatif::select('kode')->where('id', Auth::user()->id_alternatif)->first();
        if (empty($data)) {
            $data = 'Not Set';
        } else {
            $data = $data->kode;
        }
        return $data;
    }

    public function countKriteria()
    {
        $data = Kriteria::select('*')->count();

        return $data;
    }

    public function maxValueElectre()
    {
        $rank = $this->findMyRank();

        return $rank['rank'];
    }

    public function minValueElectre()
    {
        $rank = $this->findMyRank();
        return $rank['total_nilai'];
    }

    public function findMyRank()
    {
        $alternatif = Alternatif::find(Auth::user()->id_alternatif);

        if (!$alternatif) {
            $search = [
                'rank' => 'Error',
                'total_nilai'=> 0
            ];
            return $search; // Hindari error jika data tidak ditemukan
        }
        $rank = $this->hitungElectreLaravel();

        $search = Arr::first($rank, function ($item) use ($alternatif) {
            return $item['kode'] === $alternatif->kode;
        });

        return $search;
    }
    //GRAPH
    public function graph_area()
    {
        $out = array();
        $date = date('Y-');
        for ($i = 1; $i <= 12 ; $i++) {
            if ($i < 10) {
                $finder = $date.'0'.$i;
            } else {
                $finder = $date.$i;
            }
            $data = Alternatif::select('*')->where('created_at', '>=', $finder.'-00')->where('created_at', '<=', $finder.'-31')->get();
            $result = 0;
            $out[] = $result;
        }

        return json_encode($out);
    }
}
