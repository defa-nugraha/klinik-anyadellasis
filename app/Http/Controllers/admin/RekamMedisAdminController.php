<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\IstriModel;
use App\Models\PasienModel;
use App\Models\SuamiModel;
use Illuminate\Http\Request;

class RekamMedisAdminController extends Controller
{
    function detail($id)
    {
        $pasien = PasienModel::where('id', decryptStr($id))->first();
        $gender = ($pasien) ? ($pasien->gender) : null;
        $status_menikah = ($pasien) ? ($pasien->status_menikah) : null;

        $data = [
            'pasien' => $pasien
        ];
        if ($gender == 'laki-laki' && $status_menikah == 'menikah') {
            $data['suamiIstri'] = IstriModel::where('id_pasien', $pasien->id)->first();
        } elseif ($gender == 'perempuan' && $status_menikah == 'menikah') {
            $data['suamiIstri'] = SuamiModel::where('id_pasien', $pasien->id)->first();
        } else {
            $data['suamiIstri'] = false;
        }

        return view('admin.rekam-medis.detail', $data);
    }
}
