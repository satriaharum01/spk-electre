<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Models\Alternatif;

class AdminAlternatifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->data['title'] = 'Data Alternatif';
        $this->data[ 'link' ] = '/admin/alternatif';
        $this->page = 'admin/alternatif';
        $this->view = 'admin/alternatif/index';
        $this->data['page'] = $this->page;
    }

    public function index()
    {
        $this->data['sub_title'] = 'List Data Alternatif';

        return view('admin/alternatif/index', $this->data);
    }


    public function new()
    {
        $this->data['sub_title'] = 'Tambah Data ';
        $this->data['fieldTypes'] = (new Alternatif())->getField();
        $this->data['action'] = 'admin/alternatif/save';

        return view('admin/alternatif/detail', $this->data);
    }

    public function edit($id)
    {
        $rows = Alternatif::find($id);
        $this->data['title'] = 'Data Alternatif';
        $this->data['sub_title'] = 'Edit Data ';
        $this->data['fieldTypes'] = (new Alternatif())->getField();
        $this->data['load'] = $rows;
        $this->data['action'] = 'admin/alternatif/update/'.$rows->id;

        return view('admin/alternatif/detail', $this->data);
    }

    public function destroy($id)
    {
        $rows = Alternatif::findOrFail($id);
        $rows->delete();

        return redirect($this->page);
    }

    public function update(Request $request, $id)
    {
        $rows = Alternatif::find($id);

        $fillAble = (new Alternatif())->getFillable();
        $rows->update($request->only($fillAble));

        return redirect($this->page);
    }

    public function store(Request $request)
    {
        $fillAble = (new Alternatif())->getFillable();
        Alternatif::create($request->only($fillAble));

        return redirect($this->page);
    }

    public function json()
    {
        $data = Alternatif::select('*')
                ->orderby('kode', 'ASC')
                ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function find($id)
    {
        $data = Alternatif::select('*')->where('id', $id)->first();
        return json_encode($data);
    }

}
