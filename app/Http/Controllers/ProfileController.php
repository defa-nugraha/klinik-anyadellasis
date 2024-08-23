<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    function index()
    {
        $data = [
            'profil' => User::find(Auth::user()->id)
        ];

        return view('profil.index', $data);
    }

    function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('img/profil/', $filename);
            $data['foto'] = $filename;
        }

        $create = User::where('id', Auth::user()->id)->update($data);
        if ($create) {
            Alert::success('Profil diupdate!');
        } else {
            Alert::error('Profil gagal diupdate!');
        }

        return redirect()->back();
    }
}
