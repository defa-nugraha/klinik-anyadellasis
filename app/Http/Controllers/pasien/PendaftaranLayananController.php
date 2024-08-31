<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\Controller;
use App\Models\AntrianModel;
use App\Models\PasienModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranLayananController extends Controller
{
    function index()
    {
        $profil = PasienModel::where('id_user', Auth::user()->id)
            ->first();
        $antrian = AntrianModel::where([
            'id_pasien' => $profil->id
        ])->get();

        $data = [
            'antrian' => $antrian,
            'profil' => $profil
        ];

        return view('pasien.pendaftaran.index', $data);
    }
}
