<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\IstriModel;
use App\Models\PasienModel;
use App\Models\SuamiModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasienAdminController extends Controller
{
    function index()
    {
        $data = [
            'pasien' => PasienModel::orderBy('id', 'desc')->get()
        ];

        return view('admin.pasien.index', $data);
    }

    function create()
    {
        $data = [
            'users' => User::all()
        ];

        return view('admin.pasien.create', $data);
    }

    function store(Request $request)
    {
        $request->validate([
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'gender' => 'required',
            'status_menikah' => 'required',
            'email' => 'required|unique:users',
            'no_hp' => 'required'
        ]);

        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->email)
        ];

        $user = User::create($dataUser);

        $data = [
            'id_user' => $user->id,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_bpjs' => $request->no_bpjs,
            'alergi' => $request->alergi,
            'gender' => $request->gender,
            'no_rm' => $request->no_rm,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'status_menikah' => $request->status_menikah,
        ];

        $create = PasienModel::create($data);

        if ($request->status_menikah == 'menikah') {
            $request->validate([
                'nama_ss' => 'required',
                'no_bpjs_ss' => 'required',
                'pekerjaan_ss' => 'required',
                'pendidikan_ss' => 'required',
                'tempat_lahir_ss' => 'required',
                'tanggal_lahir_ss' => 'required',
            ]);

            $dataSuamiIstri = [
                'id_pasien' => $create->id,
                'nama' => $request->nama_ss,
                'no_bpjs' => $request->no_bpjs_ss,
                'no_hp' => $request->no_hp_ss,
                'pekerjaan' => $request->pekerjaan_ss,
                'pendidikan' => $request->pendidikan_ss,
                'tempat_lahir' => $request->tempat_lahir_ss,
                'tanggal_lahir' => $request->tanggal_lahir_ss
            ];

            if ($request->gender == 'laki-laki') {
                IstriModel::create($dataSuamiIstri);
            } elseif ($request->gender == 'perempuan') {
                SuamiModel::create($dataSuamiIstri);
            }
        }

        if ($create) {
            Alert::success('Pasien ditambahkan!');
        } else {
            Alert::error('Pasien gagal ditambahkan!');
        }

        return redirect('/admin/pasien');
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'id_user' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'gender' => 'required',
            'status_menikah' => 'required'
        ]);

        $data = [
            'id_user' => decryptStr($request->id_user),
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'no_bpjs' => $request->no_bpjs,
            'alergi' => $request->alergi,
            'gender' => $request->gender,
            'status_menikah' => $request->status_menikah,
        ];

        $create = PasienModel::where('id', decryptStr($request->id))->update($data);

        if ($create) {
            Alert::success('Pasien diupdate!');
        } else {
            Alert::error('Pasien gagal diupdate!');
        }

        return redirect()->back();
    }

    function delete($id)
    {
        $data = PasienModel::find(decryptStr($id));

        if ($data) {
            $data->delete();
            Alert::success('Pasien dihapus!');
        } else {
            Alert::error('Pasien gagal dihapus!');
        }

        return redirect()->back();
    }
}
