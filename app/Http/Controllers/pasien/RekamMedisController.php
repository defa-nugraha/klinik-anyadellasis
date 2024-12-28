<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use App\Models\RekamMedisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    function index()
    {
        $profil = PasienModel::where('id_user', Auth::user()->id)
            ->first();
        $rekamMedis = RekamMedisModel::where([
            'id_pasien' => ($profil) ? $profil->id : null
        ])->get();

        $poli = PoliModel::all();
        $dokter = DokterModel::all();

        $data = [
            'profil' => $profil,
            'rekamMedis' => $rekamMedis,
            'poli' => $poli,
            'dokter' => $dokter
        ];

        return view('pasien.rekam-medis.index', $data);
    }
}
