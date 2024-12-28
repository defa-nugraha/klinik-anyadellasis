<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PoliModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PoliAdminController extends Controller
{
    function index()
    {
        $data = [
            'poli' => PoliModel::all()
        ];

        return view('admin.poli.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = [
            'name' => $request->name
        ];

        $create = PoliModel::create($data);

        if ($create) {
            Alert::success('Poli berhasil ditambahkan!');
        } else {
            Alert::error('Poli berhasil ditambahkan!');
        }

        return redirect()->back();
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);

        $data = [
            'name' => $request->name
        ];

        $create = PoliModel::where('id', decryptStr($request->id))->update($data);

        if ($create) {
            Alert::success('Poli berhasil diupdate!');
        } else {
            Alert::error('Poli berhasil diupdate!');
        }

        return redirect()->back();
    }

    function delete($id)
    {
        $data = PoliModel::find(decryptStr($id));

        if ($data) {
            $data->delete();
            Alert::success('Poli berhasil dihapus!');
        } else {
            Alert::error('Poli gagal dihapus!');
        }

        return redirect()->back();
    }
}
