<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\PasienModel;
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

        $data = [
            'profil' => $profil,
            'rekamMedis' => $rekamMedis
        ];

        return view('pasien.rekam-medis.index', $data);
    }
}
