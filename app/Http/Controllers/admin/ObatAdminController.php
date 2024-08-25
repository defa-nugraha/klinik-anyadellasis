<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ObatModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ObatAdminController extends Controller
{
    function index()
    {
        $data = [
            'obat' => ObatModel::all()
        ];

        return view('admin.obat.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'bpjs' => 'required'
        ]);

        $data = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => clearDot($request->harga),
            'bpjs' => $request->bpjs
        ];

        $create = ObatModel::create($data);
        if ($create) {
            Alert::success('Obat berhasil ditambahkan');
        } else {
            Alert::error('Obat gagal ditambahkan');
        }

        return redirect()->back();
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'kode' => 'required',
            'nama' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'bpjs' => 'required'
        ]);

        $data = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => clearDot($request->harga),
            'bpjs' => $request->bpjs
        ];

        $update = ObatModel::where('id', decryptStr($request->id))->update($data);
        if ($update) {
            Alert::success('Obat berhasil diupdate');
        } else {
            Alert::error('Obat gagal diupdate');
        }

        return redirect()->back();
    }

    function delete($id)
    {
        $data = ObatModel::find(decryptStr($id));
        if ($data) {
            $data->delete();
            Alert::success('Obat berhasil dihapus!');
        } else {
            Alert::error('Obat gagal dihapus!');
        }

        return redirect()->back();
    }
}
