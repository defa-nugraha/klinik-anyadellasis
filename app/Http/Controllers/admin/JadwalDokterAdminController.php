<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\JadwalDokterModel;;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalDokterAdminController extends Controller
{
    function index()
    {
        $data = [
            'jadwal' => JadwalDokterModel::orderBy('hari', 'ASC')->get(),
            'dokter' => DokterModel::all(),
        ];

        return view('admin.jadwal-dokter.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        $data = [
            'id_dokter' => $request->id_dokter,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ];

        $create = JadwalDokterModel::create($data);

        if ($create) {
            Alert::success('Jadwal Dokter berhasil ditambahkan!');
        } else {
            Alert::error('Jadwal Dokter gagal ditambahkan!');
        }

        return redirect()->back();
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);

        $data = [
            'id_dokter' => $request->id_dokter,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ];

        $update = JadwalDokterModel::where('id', decryptStr($request->id))->update($data);

        if ($update) {
            Alert::success('Jadwal Dokter berhasil diupdate!');
        } else {
            Alert::error('Jadwal Dokter gagal diupdate!');
        }

        return redirect()->back();
    }

    function delete($id)
    {
        $data = JadwalDokterModel::find(decryptStr($id));
        if ($data) {
            $delete = $data->delete();
            if ($delete) {
                Alert::success('Jadwal Dokter berhasil dihapus!');
            } else {
                Alert::error('Jadwal Dokter gagal dihapus!');
            }
            return redirect()->back();
        }
        return redirect()->back();
    }
}
