<?php

namespace App\Http\Controllers\pasien;

use App\Http\Controllers\admin\AntrianAdminController;
use App\Http\Controllers\Controller;
use App\Models\AntrianModel;
use App\Models\DokterModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranLayananController extends AntrianAdminController
{
    function index()
    {
        $profil = PasienModel::where('id_user', Auth::user()->id)
            ->first();
        $antrian = AntrianModel::where([
            'id_pasien' => $profil->id
        ])
            ->orderBy('tanggal_periksa', 'desc')
            ->get();

        $poli = PoliModel::all();
        $dokter = DokterModel::all();

        $data = [
            'antrian' => $antrian,
            'profil' => $profil,
            'poli' => $poli,
            'dokter' => $dokter
        ];

        return view('pasien.pendaftaran.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'tanggal_periksa' => 'required',
            'dokter' => 'required',
            'poli' => 'required',
        ]);

        $profil = PasienModel::where('id_user', Auth::user()->id)
            ->first();

        $data = [
            'tanggal_periksa' => $request->tanggal_periksa,
            'id_dokter' => decryptStr($request->dokter),
            'id_pasien' => $profil->id,
            'id_poli' => decryptStr($request->poli),
            'status' => 'antri'
        ];

        // generate nomor antrian
        $nomorAntrian = $this->generateNomorAntrian($request->tanggal_periksa);
        $data['no_antrian'] = $nomorAntrian;

        // generate kode booking
        $kodeBooking = $this->generateKodeBooking(encryptStr($profil->id));
        $data['kode_booking'] = $kodeBooking;

        $create = AntrianModel::create($data);
        if ($create) {
            Alert::success('Atrian ditambahkan!');
        } else {
            Alert::error('Atrian gagal ditambahkan!');
        }

        return redirect()->back();
    }
}
