<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\IstriModel;
use App\Models\PasienModel;
use App\Models\SuamiModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasienController extends Controller
{
    function store(Request $request)
    {
        $request->validate([
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'no_hp' => 'required',
            'gender' => 'required',
            'status_menikah' => 'required',
            'no_hp' => 'required'
        ]);

        $dataUser = [
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        // update alamat di user
        $user = User::where('id', Auth::user()->id)->update($dataUser);

        if (!$user) {
            Alert::error('Terjadi kesalahan!');
            return redirect()->back();
        }

        $data = [
            'id_user' => Auth::user()->id,
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
            Alert::success('Berhasil disimpan!');
        } else {
            Alert::error('Gagal disimpan!');
        }

        return redirect()->back();
    }
}
