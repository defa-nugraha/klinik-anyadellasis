<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiagnosaModel;
use App\Models\RekamMedisModel;
use App\Models\SubDiagnosaModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DiagnosaAdminController extends Controller
{
    function createOrUpdate(Request $request)
    {
        $request->validate([
            'rekam_medis' => 'required',
            'icd' => 'required',
        ]);

        $data = [
            'deskripsi' => $request->diagnosa,
            'id_rekam_medis' => decryptStr($request->rekam_medis)
        ];


        if ($request->hasFile('file_diagnosa')) {
            $fileName = time() . '.' . $request->file('file_diagnosa')->extension();
            // move
            $request->file('file_diagnosa')->move(public_path('file/diagnosa'), $fileName);
            $data['file_diagnosa'] = $fileName;
        }

        $create = DiagnosaModel::updateOrCreate(['id_rekam_medis' => decryptStr($request->rekam_medis)], $data);

        foreach ($request->icd as $key => $value) {
            SubDiagnosaModel::create([
                'id_diagnosa' => $create->id,
                'id_icd' => decryptStr($value)
            ]);
        }

        if ($create) {
            // update id pemeriksaan di rekam medis
            RekamMedisModel::where('id', decryptStr($request->rekam_medis))->update(['id_diagnosa' => $create->id]);
            Alert::success("Diagnosa diupdate!");
        } else {
            Alert::error("Diagnosa gagal diupdate!");
        }

        return redirect()->back();
    }
}
