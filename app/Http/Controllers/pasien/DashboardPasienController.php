<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\AntrianModel;
use App\Models\DokterModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use App\Models\RekamMedisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPasienController extends Controller
{
    function index()
    {
        $profil = PasienModel::where('id_user', Auth::user()->id)
            ->first();
        $antrian = AntrianModel::where([
            'id_pasien' => ($profil) ? $profil->id : null,
        ])
            ->whereNot('status', 'di proses')
            ->first();
        $rekamMedis = RekamMedisModel::where([
            'id_pasien' => ($profil) ? $profil->id : null,
        ])
            ->orderBy('tgl_pemeriksaan', 'desc')
            ->first();
        $poli = PoliModel::all();
        $dokter = DokterModel::all();

        $data = [
            'profil' => $profil,
            'antrian' => $antrian,
            'rekamMedis' => $rekamMedis,
            'poli' => $poli,
            'dokter' => $dokter
        ];

        return view('pasien.dashboard.index', $data);
    }

    function profil()
    {
        return redirect()->back();
    }
}
