<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AntrianModel;
use App\Models\DokterModel;
use App\Models\PasienModel;
use App\Models\PoliModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AntrianAdminController extends Controller
{
    function index()
    {
        $data = [
            'antrian' => AntrianModel::where([
                // 'status' => 'antri',
                'tanggal_periksa' => date('Y-m-d')
            ])->orderBy('no_antrian', 'asc')->get(),
            'dokter' => DokterModel::all(),
            'pasien' => PasienModel::all(),
            'poli' => PoliModel::all()
        ];

        return view('admin.antrian.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'tanggal_periksa' => 'required',
            'dokter' => 'required',
            'pasien' => 'required',
            'poli' => 'required',
        ]);

        $data = [
            'tanggal_periksa' => $request->tanggal_periksa,
            'id_dokter' => decryptStr($request->dokter),
            'id_pasien' => decryptStr($request->pasien),
            'id_poli' => decryptStr($request->poli),
            'status' => 'antri'
        ];

        // generate nomor antrian
        $nomorAntrian = $this->generateNomorAntrian($request->tanggal_periksa);
        $data['no_antrian'] = $nomorAntrian;

        // generate kode booking
        $kodeBooking = $this->generateKodeBooking($request->pasien);
        $data['kode_booking'] = $kodeBooking;

        $create = AntrianModel::create($data);
        if ($create) {
            Alert::success('Atrian ditambahkan!');
        } else {
            Alert::error('Atrian gagal ditambahkan!');
        }

        return redirect()->back();
    }

    function generateNomorAntrian($tanggal)
    {
        // Format tanggal: YYYYMMDD, misal: 20240822
        $formattedDate = date('md', strtotime($tanggal));

        $totalPasienHariIni = AntrianModel::where('tanggal_periksa', $tanggal)->count();
        // Total pasien pada hari itu ditambah 1 untuk nomor antrian berikutnya
        $nomorUrut = str_pad($totalPasienHariIni + 1, 3, '0', STR_PAD_LEFT);

        // Gabungkan menjadi nomor antrian
        $nomorAntrian = $formattedDate . $nomorUrut;

        return $nomorAntrian;
    }

    function generateKodeBooking($id_pasien)
    {
        // Ambil inisial nama pasien (misal: dari "John Doe" menjadi "JD")
        $namaPasien = PasienModel::find(decryptStr($id_pasien))->user->name;
        $inisial = '';
        $namaParts = explode(' ', strtoupper($namaPasien));
        foreach ($namaParts as $part) {
            $inisial .= substr($part, 0, 1);
        }

        // Format timestamp
        $formattedDate = date('YmdHis', strtotime(date('Y-m-d H:i:s')));

        // Gabungkan inisial dengan angka acak menjadi kode booking
        $kodeBooking = $inisial . $formattedDate;

        return $kodeBooking;
    }

    function delete($id)
    {
        $data = AntrianModel::find(decryptStr($id));

        if ($data) {
            $data->delete();
            Alert::success('Atrian dihapus!');
        } else {
            Alert::error('Atrian gagal dihapus!');
        }

        return redirect()->back();
    }

    function proses($id_antrian)
    {
        $antrian = AntrianModel::find(decryptStr($id_antrian));

        if (!$antrian) {
            Alert::error('Atrian tidak ditemukan!');
            return redirect()->back();
        }

        if ($antrian->status != 'antri') {
            Alert::error('Terjadi kesalahan!');
            return redirect()->back();
        }

        // update status antrian
        $antrian->status = 'proses';
        $antrian->save();

        return redirect(route('admin.rekam_medis.createFromAntrian', encryptStr($antrian->id)));
    }
}
