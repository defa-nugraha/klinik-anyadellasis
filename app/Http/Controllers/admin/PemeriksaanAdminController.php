<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanModel;
use App\Models\RekamMedisModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PemeriksaanAdminController extends Controller
{
    function createOrUpdate(Request $request)
    {
        $request->validate([
            'rekam_medis' => 'required',
        ]);

        $data = [
            'deskripsi' => $request->pemeriksaan,
            'id_rekam_medis' => decryptStr($request->rekam_medis)
        ];

        if ($request->hasFile('file_pemeriksaan')) {
            $fileName = time() . '.' . $request->file('file_pemeriksaan')->extension();
            // move
            $request->file('file_pemeriksaan')->move(public_path('file/pemeriksaan'), $fileName);
            $data['file_pemeriksaan'] = $fileName;
        }

        $create = PemeriksaanModel::updateOrCreate(['id_rekam_medis' => decryptStr($request->rekam_medis)], $data);
        if ($create) {
            // update id pemeriksaan di rekam medis
            RekamMedisModel::where('id', decryptStr($request->rekam_medis))->update(['id_pemeriksaan' => $create->id]);
            Alert::success("Pemeriksaan diupdate!");
        } else {
            Alert::error("Pemeriksaan gagal diupdate!");
        }

        return redirect()->back();
    }
}
