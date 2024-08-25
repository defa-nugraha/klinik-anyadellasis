<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PetugasAdminController extends Controller
{
    function index()
    {
        $data = [
            'petugas' => User::whereNot('role', 'patient')->orderBy('role', 'asc')->get()
        ];

        return view('admin.petugas.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'no_hp' => 'required',
            'alamat' => 'required',
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->email),
            'role' => $request->role
        ];

        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('img/profil/', $filename);

            $data['foto'] = $filename;
        }

        $create = User::create($data);

        if ($create) {
            Alert::success('Petugas berhasil ditambahkan!');
        } else {
            Alert::error('Petugas gagal ditambahkan!');
        }

        return redirect()->back();
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'role' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->email),
            'role' => $request->role
        ];

        if ($request->hasFile('foto')) {
            $filename = time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('img/profil/', $filename);

            $data['foto'] = $filename;
        }

        $update = User::where('id', decryptStr($request->id))->update($data);

        if ($update) {
            Alert::success('Petugas berhasil diupdate!');
        } else {
            Alert::error('Petugas gagal diupdate!');
        }

        return redirect()->back();
    }

    function delete($id)
    {
        $data = User::find(decryptStr($id));

        if ($data) {
            $data->delete();
            Alert::success('Petugas dihapus!');
        } else {
            Alert::error('Petugas gagal dihapus!');
        }

        return redirect()->back();
    }
}
