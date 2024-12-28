<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\JadwalDokterModel;
use App\Models\PasienModel;
use App\Models\RekamMedisModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardDokterController extends Controller
{
    function index()
    {
        $profil = DokterModel::where('id_user', Auth::user()->id)->first();

        $pasienHariIni = RekamMedisModel::where([
            'tgl_pemeriksaan' => date('Y-m-d'),
            'id_dokter' => $profil->id
        ])->get();
        $totalRekamMedisSelesai = RekamMedisModel::where([
            'id_dokter' => $profil->id,
        ])->get();

        $pasien = PasienModel::all();
        $dokter = DokterModel::all();
        $jadwalDokter = JadwalDokterModel::where([
            'hari' => namaHariIndonesia(date('Y-m-d'))
        ])->get();

        $data = [
            'pasienHariIni' => $pasienHariIni,
            'pasien' => $pasien,
            'dokter' => $dokter,
            'jadwalDokter' => $jadwalDokter,
            'totalRekamMedisSelesai' => $totalRekamMedisSelesai
        ];

        return view('dokter.dashboard.index', $data);
    }
}
