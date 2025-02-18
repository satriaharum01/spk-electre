<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DataTables;
use App\Models\Alternatif;
use App\Models\User;

class AdminPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->data['title'] = 'Data Pengguna';
        $this->data[ 'link' ] = '/admin/pengguna';
        $this->page = 'admin/pengguna';
        $this->view = 'admin/pengguna/index';
        $this->data['page'] = $this->page;
    }

    public function index()
    {
        $this->data['sub_title'] = 'List Data Pengguna';

        return view('admin/pengguna/index', $this->data);
    }


    public function new()
    {
        $this->data['sub_title'] = 'Tambah Data ';
        $this->data['fieldTypes'] = (new User())->getField();
        $this->data['action'] = 'admin/pengguna/save';

        return view('admin/pengguna/detail', $this->data);
    }

    public function edit($id)
    {
        $rows = User::find($id);
        $this->data['title'] = 'Data Pengguna';
        $this->data['sub_title'] = 'Edit Data ';
        $this->data['fieldTypes'] = (new User())->getField();
        $this->data['load'] = $rows;
        $this->data['action'] = 'admin/pengguna/update/'.$rows->id;

        return view('admin/pengguna/detail', $this->data);
    }

    public function update(Request $request, $id)
    {
        $rows = User::find($id);

        $fillAble = (new User())->getFillable();
        $data = $request->only($fillAble);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $rows->update($data);

        return redirect($this->page);
    }

    public function store(Request $request)
    {
        $fillAble = (new User())->getFillable();

        $data = $request->only($fillAble);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        User::create($data);

        return redirect($this->page);
    }

    public function destroy($id)
    {
        $rows = User::findOrFail($id);
        $rows->delete();

        return redirect($this->page);
    }

    public function json()
    {
        $data = Alternatif::select('*')
                ->orderby('kode', 'ASC')
                ->get();

        foreach ($data as $row) {
            if ($row->level != 'Admin') {
                $cek = User::select('*')->where('id_alternatif', $row->id)->first();
                if (!$cek) {
                    $row->level = 'Belum Memiliki Akses';
                    $row->email = 'Belum Memiliki Akses';
                    $row->status = 'invalid';
                } else {
                    $row->level = $cek->level;
                    $row->email = $cek->email;
                    $row->status = 'valid';
                }
            } else {
                $row->level = $cek->level;
                $row->email = $cek->email;
                $row->status = 'valid';
            }
        }
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
