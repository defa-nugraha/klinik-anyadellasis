<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedisModel;
use App\Models\TindakanModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TindakanAdminController extends Controller
{
    function createOrUpdate(Request $request)
    {
        $request->validate([
            'rekam_medis' => 'required',
        ]);

        $data = [
            'deskripsi' => $request->tindakan,
            'id_rekam_medis' => decryptStr($request->rekam_medis)
        ];

        if ($request->hasFile('file_tindakan')) {
            $fileName = time() . '.' . $request->file('file_tindakan')->extension();
            // move
            $request->file('file_tindakan')->move(public_path('file/tindakan'), $fileName);
            $data['file_tindakan'] = $fileName;
        }

        $create = TindakanModel::updateOrCreate(['id_rekam_medis' => decryptStr($request->rekam_medis)], $data);
        if ($create) {
            // update id pemeriksaan di rekam medis
            RekamMedisModel::where('id', decryptStr($request->rekam_medis))->update(['id_tindakan' => $create->id]);
            Alert::success("Tindakan diupdate!");
        } else {
            Alert::error("Tindakan gagal diupdate!");
        }

        return redirect()->back();
    }
}
