<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DokterModel;
use App\Models\IstriModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use App\Models\RekamMedisKandunganModel;
use App\Models\RekamMedisModel;
use App\Models\SuamiModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RekamMedisAdminController extends Controller
{
    function index()
    {
        $data = [
            'rekamMedis' => RekamMedisModel::all()
        ];

        return view('admin.rekam-medis.index', $data);
    }

    function create()
    {
        $data = [
            'pasien' => PasienModel::all(),
            'poli' => PoliModel::all(),
            'dokter' => DokterModel::all()
        ];

        return view('admin.rekam-medis.create', $data);
    }
    function detail($id)
    {
        $pasien = PasienModel::where('id', decryptStr($id))->first();
        $gender = ($pasien) ? ($pasien->gender) : null;
        $status_menikah = ($pasien) ? ($pasien->status_menikah) : null;

        $data = [
            'pasien' => $pasien,
            'rekamMedis' => RekamMedisModel::where('id_pasien', $pasien->id)->get(),
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

    function store(Request $request)
    {
        $request->validate([
            'kandungan' => 'required',
            'tgl_pemeriksaan' => 'required',
            'pasien' => 'required',
            'nama_pasien' => 'required',
            'jenis_pembayaran' => 'required',
            'ammanesia' => 'required',
            'riwayat_penyakit' => 'required',
            'riwayat_penyakit_keluarga' => 'required',
            'poli' => 'required',
            'dokter' => 'required',
        ]);

        $data = [
            'kandungan' => $request->kandungan,
            'tgl_pemeriksaan' => $request->tgl_pemeriksaan,
            'id_pasien' => $request->pasien,
            'nama_pasien' => $request->nama_pasien,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'ammanesia' => $request->ammanesia,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'riwayat_penyakit_keluarga' => $request->riwayat_penyakit_keluarga,
            'id_poli' => $request->poli,
            'id_dokter' => $request->dokter
        ];

        $create = RekamMedisModel::create($data);
        if ($request->kandungan == 1) {
            $kandungan = [
                'id_rekam_medis' => $create->id,
                'a' => $request->a,
                'g' => $request->g,
                'p' => $request->p,
            ];

            $createRekamMedisKandungan = RekamMedisKandunganModel::create($kandungan);

            // update id_rm_kandungan
            $create->id_rm_kandungan = $createRekamMedisKandungan->id;
            $create->save();
        }

        if ($create) {
            Alert::success('Rekam Medis berhasil ditambahkan!');
        } else {
            Alert::error('Rekam Medis gagal ditambahkan!');
        }

        return redirect('admin/rekam_medis');
    }
}
