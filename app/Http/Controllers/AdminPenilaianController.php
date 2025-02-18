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

class AdminPenilaianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->data['title'] = 'Data Penilaian';
        $this->data[ 'link' ] = '/admin/penilaian';
        $this->page = 'admin/penilaian';
        $this->view = 'admin/penilaian/index';
        $this->data['page'] = $this->page;
    }

    public function index()
    {
        $this->data['sub_title'] = 'List Data Penilaian';
        $kriteria = Kriteria::select('*')->orderBy('kode', 'ASC')->get();
        $this->data['kriteria'] = $kriteria;

        return view('admin/penilaian/index', $this->data);
    }


    public function edit($id)
    {
        $alternatif = Alternatif::find($id);
        $this->data['title'] = 'Nilai Alternatif';
        $this->data['sub_title'] = 'Edit Data ';
        $load = Penilaian::where('id_alternatif', $id)->pluck('nilai', 'id_kriteria');
        $this->data['load'] = $load;
        $this->data['alternatif'] = $alternatif;
        $this->data['action'] = 'admin/penilaian/update/'.$alternatif->id;
        $kriteria = Kriteria::orderBy('kode', 'ASC')->with('subKriteria')->get();

        $this->data['kriteria'] = $kriteria;

        return view('admin/penilaian/detail', $this->data);
    }

    public function destroy($id)
    {
        $rows = Penilaian::select('*')->where('id_alternatif', $id);
        $rows->delete();

        return redirect($this->page);
    }

    public function update(Request $request, $id)
    {
        $data = $request->input('kriteria');

        foreach ($data as $id_kriteria => $values) {
            Penilaian::updateOrCreate(
                ['id_alternatif' => $id, 'id_kriteria' => $id_kriteria],
                ['nilai' => $values['nilai']]
            );
        }

        return redirect($this->page);
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

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($id)
    {
        $data = Penilaian::select('*')->where('id', $id)->first();
        return json_encode($data);
    }

}
