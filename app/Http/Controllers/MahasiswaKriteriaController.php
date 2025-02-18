<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Models\Kriteria;
use App\Models\SubKriteria;

class MahasiswaKriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->data['title'] = 'Data Kriteria';
        $this->data[ 'link' ] = '/mahasiswa/kriteria';
        $this->page = 'mahasiswa/kriteria';
        $this->view = 'mahasiswa/kriteria/index';
        $this->data['page'] = $this->page;
    }

    public function index()
    {
        $this->data['sub_title'] = 'List Data Kriteria';

        return view('mahasiswa/kriteria/index', $this->data);
    }


    public function new()
    {
        $this->data['sub_title'] = 'Tambah Data ';
        $this->data['fieldTypes'] = (new Kriteria())->getField();
        $this->data['action'] = 'mahasiswa/kriteria/save';

        return view('mahasiswa/kriteria/detail', $this->data);
    }

    public function edit($id)
    {
        $rows = Kriteria::find($id);
        $this->data['title'] = 'Data Kriteria';
        $this->data['sub_title'] = 'Edit Data ';
        $this->data['fieldTypes'] = (new Kriteria())->getField();
        $this->data['load'] = $rows;
        $this->data['action'] = 'mahasiswa/kriteria/update/'.$rows->id;

        return view('mahasiswa/alternatif/detail', $this->data);
    }

    public function detail($id)
    {
        $rows = Kriteria::find($id);
        $this->data['sub_title'] = 'Sub Kriteria '.$rows->nama_kriteria;
        $this->data['id_kriteria'] = $rows->id;
        $this->data['title'] = 'Data Sub Kriteria';
        $this->data['page'] = 'mahasiswa/kriteria/'.$rows->id;

        return view('mahasiswa/kriteria/sub', $this->data);
    }

    public function destroy($id)
    {
        $rows = Kriteria::findOrFail($id);
        $rows->delete();

        return redirect($this->page);
    }

    public function update(Request $request, $id)
    {
        $rows = Kriteria::find($id);

        $fillAble = (new Kriteria())->getFillable();
        $rows->update($request->only($fillAble));

        return redirect($this->page);
    }

    public function store(Request $request)
    {
        $fillAble = (new Kriteria())->getFillable();
        Kriteria::create($request->only($fillAble));

        return redirect($this->page);
    }

    public function json()
    {
        $data = Kriteria::select('*')
                ->orderby('nama_kriteria', 'ASC')
                ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($id)
    {
        $data = Kriteria::select('*')->where('id', $id)->first();
        return json_encode($data);
    }

    //Sub Kriteria

    public function destroy_sub($od, $id)
    {
        $rows = SubKriteria::findOrFail($id);
        $rows->delete();

        return redirect('mahasiswa/kriteria/detail/'.$od);
    }

    public function update_sub(Request $request, $od, $id)
    {
        $rows = SubKriteria::find($id);

        $fillAble = (new SubKriteria())->getFillable();
        $rows->update($request->only($fillAble));

        return redirect('mahasiswa/kriteria/detail/'.$od);
    }

    public function store_sub(Request $request, $od)
    {
        $fillAble = (new SubKriteria())->getFillable();
        SubKriteria::create($request->only($fillAble));

        return redirect('mahasiswa/kriteria/detail/'.$od);
    }

    public function json_sub($od)
    {
        $data = SubKriteria::select('*')
                ->where('id_kriteria', $od)
                ->orderby('nilai', 'DESC')
                ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find_sub($od, $id)
    {
        $data = SubKriteria::select('*')->where('id', $id)->first();
        return json_encode($data);
    }
}
