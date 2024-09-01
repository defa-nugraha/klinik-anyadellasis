<?php

namespace App\Http\Controllers\nurse;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\JadwalDokterModel;
use App\Models\PasienModel;
use App\Models\RekamMedisModel;
use Illuminate\Http\Request;

class DashboardNurseController extends Controller
{
    function index()
    {
        $pasienHariIni = RekamMedisModel::where('tgl_pemeriksaan', date('Y-m-d'))->get();
        $pasien = PasienModel::all();
        $dokter = DokterModel::all();
        $jadwalDokter = JadwalDokterModel::where([
            'hari' => namaHariIndonesia(date('Y-m-d'))
        ])->get();

        $data = [
            'pasienHariIni' => $pasienHariIni,
            'pasien' => $pasien,
            'dokter' => $dokter,
            'jadwalDokter' => $jadwalDokter
        ];

        return view('nurse.dashboard.index', $data);
    }
}
