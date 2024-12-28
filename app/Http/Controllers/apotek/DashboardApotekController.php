<?php

namespace App\Http\Controllers\apotek;

use App\Http\Controllers\Controller;
use App\Models\ObatKeluarModel;
use App\Models\ObatModel;
use App\Models\RekamMedisModel;
use Illuminate\Http\Request;

class DashboardApotekController extends Controller
{
    function index()
    {
        $obat = ObatModel::all();
        $obatKeluar = ObatKeluarModel::all();
        $permintaanObat = RekamMedisModel::where('status', 'di apotek')->get();

        $data = [
            'obat' => $obat,
            'obatKeluar' => $obatKeluar,
            'permintaanObat' => $permintaanObat
        ];

        return view('apotek.dashboard.index', $data);
    }
}
