<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\PoliModel;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DokterAdminController extends Controller
{
    function index()
    {
        $data = [
            'dokter' => DokterModel::all(),
            'users' => User::where('role', 'doctor')->get(),
            'poli' => PoliModel::all()
        ];

        return view('admin.dokter.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'poli' => 'required',
            'spesialis' => 'required'
        ]);

        $data = [
            'id_user' => decryptStr($request->user),
            'id_poli' => decryptStr($request->poli),
            'spesialis' => $request->spesialis
        ];

        $create = DokterModel::create($data);

        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('img/dokter/', $filename);

            // update foto user
            $user = User::find(decryptStr($request->user));
            $user->foto = $filename;
            $user->save();
        }
        if ($create) {
            Alert::success('Dokter berhasil ditambahkan');
        } else {
            Alert::error('Dokter gagal ditambahkan');
        }

        return redirect()->back();
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'user' => 'required',
            'poli' => 'required',
            'spesialis' => 'required'
        ]);

        $data = [
            'id_user' => decryptStr($request->user),
            'id_poli' => decryptStr($request->poli),
            'spesialis' => $request->spesialis
        ];

        $update = DokterModel::where('id', decryptStr($request->id))->update($data);

        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('img/profil/', $filename);

            // update foto user
            $user = User::find(decryptStr($request->user));
            $user->foto = $filename;
            $user->save();
        }

        if ($update) {
            Alert::success('Dokter berhasil diupdate');
        } else {
            Alert::error('Dokter gagal diupdate');
        }

        return redirect()->back();
    }

    function delete($id)
    {
        $data = DokterModel::find(decryptStr($id));

        if ($data) {
            $data->delete();
            Alert::success('Dokter berhasil di hapus');
        } else {
            Alert::error('Dokter gagal di hapus');
        }

        return redirect()->back();
    }
}
