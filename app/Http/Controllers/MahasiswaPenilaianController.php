<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Penilaian;

class MahasiswaPenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->data['title'] = 'Data Penilaian';
        $this->data[ 'link' ] = '/mahasiswa/penilaian';
        $this->page = 'mahasiswa/penilaian';
        $this->view = 'mahasiswa/penilaian/index';
        $this->data['page'] = $this->page;
    }

    public function index()
    {
        $id = Auth::user()->id_alternatif;
        $alternatif = Alternatif::find($id);
        $this->data['title'] = 'Nilai Alternatif';
        $this->data['sub_title'] = 'List Data ';
        $load = Penilaian::where('id_alternatif', $id)->pluck('nilai', 'id_kriteria');
        $this->data['load'] = $load;
        $this->data['alternatif'] = $alternatif;
        $this->data['action'] = 'mahasiswa/penilaian/update/'.$alternatif->id;
        $kriteria = Kriteria::orderBy('kode', 'ASC')->with('subKriteria')->get();

        $this->data['kriteria'] = $kriteria;

        return view('mahasiswa/penilaian/detail', $this->data);
    }



    public function json()
    {
        $data = Alternatif::with(['penilaian.cariKriteria'])->get();

        $kriteria = Kriteria::orderBy('kode', 'ASC')->get();

        foreach ($data as $row) {
            foreach ($kriteria as $arr) {
                $penilaian = $row->penilaian->where('id_kriteria', $arr->id)->first();

                if (!$penilaian) {
                    $row->{$arr->kode} = 'Belum Diisi';
                } else {
                    $sub_kriteria = SubKriteria::select('sub_kriteria')->where('id_kriteria', $penilaian->id_kriteria)->where('nilai', $penilaian->nilai)->first();
                    $row->{$arr->kode} = $sub_kriteria ? $sub_kriteria->sub_kriteria : 'Belum Diisi';
                }
            }
        }

        return $data;
    }
}
