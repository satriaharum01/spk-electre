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

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        //$this->middleware('is_admin');
    }

    /*
     * Dashboad Function
    */
    public function index()
    {
        $electreData = $this->hitungElectreLaravel();
        usort($electreData, fn ($a, $b) => $a['total_nilai'] <=> $b['total_nilai']);

        $this->data = [
            'title' => 'Dashboard Admin',
            'c_alternatif' => Alternatif::count(),
            'c_kriteria' => Kriteria::count(),
            'c_max' => end($electreData)['nama'],
            'c_min' => $electreData[0]['nama']
        ];

        usort($electreData, fn($a, $b) => strnatcmp($a['kode'], $b['kode']));
        $this->data['chart'] = $electreData;

        return view('admin/dashboard/index', $this->data);
    }
}
