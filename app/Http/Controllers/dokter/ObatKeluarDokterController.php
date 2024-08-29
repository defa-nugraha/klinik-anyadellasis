<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\IstriModel;
use App\Models\ObatKeluarModel;
use App\Models\PasienModel;
use App\Models\RekamMedisModel;
use App\Models\SuamiModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ObatKeluarDokterController extends Controller
{
    function detail($id_rm)
    {
        $rekamMedis = RekamMedisModel::find(decryptStr($id_rm));

        if (!$rekamMedis) {
            Alert::error('Rekam medis tidak ditemukan!');
            return redirect()->back();
        }

        $riwayatObat = ObatKeluarModel::where('id_rekam_medis', $rekamMedis->id)->get();

        $pasien = PasienModel::find($rekamMedis->id_pasien);
        $gender = ($pasien) ? ($pasien->gender) : null;
        $status_menikah = ($pasien) ? ($pasien->status_menikah) : null;
        $data = [
            'rekamMedis' => $rekamMedis,
            'pasien' => $pasien,
            'riwayatObat' => $riwayatObat
        ];
        // dd($riwayatObat);
        if ($gender == 'laki-laki' && $status_menikah == 'menikah') {
            $data['suamiIstri'] = IstriModel::where('id_pasien', $pasien->id)->first();
        } elseif ($gender == 'perempuan' && $status_menikah == 'menikah') {
            $data['suamiIstri'] = SuamiModel::where('id_pasien', $pasien->id)->first();
        } else {
            $data['suamiIstri'] = false;
        }

        return view('dokter.obat.riwayat.detail', $data);
    }
}
