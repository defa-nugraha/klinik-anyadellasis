<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AntrianModel;
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
            'rekamMedis' => RekamMedisModel::orderBy('created_at', 'desc')->get(),
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
            'rekamMedis' => RekamMedisModel::where('id_pasien', $pasien->id)->orderBy('id', 'desc')->get(),
            'statusRekamMedis' => RekamMedisModel::whereNot('status', 'selesai')
                ->where('id_pasien', $pasien->id)
                ->orderBy('created_at', 'desc')->first(),
        ];

        // dd($data);
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
            'anamnesa' => 'required',
            'riwayat_penyakit' => 'required',
            'riwayat_penyakit_keluarga' => 'required',
            'poli' => 'required',
            'dokter' => 'required',
        ]);

        // cek apakah ada rekam medis yang belum selesai?
        $cek = RekamMedisModel::where('id_pasien', $request->pasien)->whereNot('status', 'selesai')->first();
        if ($cek) {
            Alert::error('Pasien ini masih belum selesai periksa, harap selesaikan pemeriksaan sebelumnya!');
            return redirect()->back();
        }

        $data = [
            'kandungan' => $request->kandungan,
            'tgl_pemeriksaan' => $request->tgl_pemeriksaan,
            'id_pasien' => $request->pasien,
            'nama_pasien' => $request->nama_pasien,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'anamnesa' => $request->anamnesa,
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

    function updateStatus(Request $request)
    {
        $request->validate([
            'rekam_medis' => "required",
            'status' => 'required'
        ]);

        $rekamMedis = RekamMedisModel::find(decryptStr($request->rekam_medis));

        if ($rekamMedis) {
            if ($request->status == 'pemeriksaan' && !$rekamMedis->id_pemeriksaan) {
                Alert::error('Isi pemeriksaan terlebih dahulu!');
                return redirect()->back();
            } elseif ($request->status == 'di apotek' && !$rekamMedis->id_diagnosa && !$rekamMedis->id_tindakan) {
                Alert::error('Tindakan dan diagnosa belum diisi!');
                return redirect()->back();
            }
            $rekamMedis->status = $request->status;
            $rekamMedis->save();

            Alert::success('Rekam Medis berhasil diupdate!');
        } else {
            Alert::error('Rekam Medis tidak ditemukan!');
        }

        return redirect()->back();
    }

    function createFromAntrian($id_antrian)
    {
        $antrian = AntrianModel::find(decryptStr($id_antrian));
        if (!$antrian) {
            Alert::error('Antrian tidak ditemukan!');
            return redirect()->back();
        }

        $data = [
            'pasien' => PasienModel::find($antrian->id_pasien),
            'poli' => PoliModel::all(),
            'dokter' => DokterModel::all(),
            'antrian' => $antrian
        ];

        return view('admin.rekam-medis.create-from-antrian', $data);
    }
}
