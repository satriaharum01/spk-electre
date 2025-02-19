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

    public function json()
    {
        $rankedData = $this->hitungElectreLaravel();

        return Datatables::of($rankedData)->addIndexColumn()->make(true);
    }
}
