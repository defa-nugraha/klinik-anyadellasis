<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\IstriModel;
use App\Models\ObatKeluarModel;
use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\RekamMedisModel;
use App\Models\SuamiModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ObatAdminController extends Controller
{
    function index()
    {
        $data = [
            'obat' => ObatModel::all()
        ];

        return view('admin.obat.index', $data);
    }

    function create(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'bpjs' => 'required'
        ]);

        $data = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => clearDot($request->harga),
            'bpjs' => $request->bpjs
        ];

        $create = ObatModel::create($data);
        if ($create) {
            Alert::success('Obat berhasil ditambahkan');
        } else {
            Alert::error('Obat gagal ditambahkan');
        }

        return redirect()->back();
    }

    function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'kode' => 'required',
            'nama' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'bpjs' => 'required'
        ]);

        $data = [
            'kode' => $request->kode,
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => clearDot($request->harga),
            'bpjs' => $request->bpjs
        ];

        $update = ObatModel::where('id', decryptStr($request->id))->update($data);
        if ($update) {
            Alert::success('Obat berhasil diupdate');
        } else {
            Alert::error('Obat gagal diupdate');
        }

        return redirect()->back();
    }

    function delete($id)
    {
        $data = ObatModel::find(decryptStr($id));
        if ($data) {
            $data->delete();
            Alert::success('Obat berhasil dihapus!');
        } else {
            Alert::error('Obat gagal dihapus!');
        }

        return redirect()->back();
    }


    function resep()
    {
        $data = [
            'resep' => RekamMedisModel::where('status', 'di apotek')->orderBy('updated_at', 'desc')->get()
        ];
        return view('admin.obat.resep', $data);
    }

    function createResep($id_rm)
    {
        $rekamMedis = RekamMedisModel::find(decryptStr($id_rm));

        if (!$rekamMedis) {
            Alert::error('Rekam medis tidak ditemuka!');
            return redirect()->back();
        }

        if ($rekamMedis->status == 'selesai') {
            Alert::success('Rekam medis sudah selesai!');
            return redirect('admin/obat/resep');
        }

        $pasien = PasienModel::find($rekamMedis->id_pasien);
        $gender = ($pasien) ? ($pasien->gender) : null;
        $status_menikah = ($pasien) ? ($pasien->status_menikah) : null;
        $data = [
            'rekamMedis' => $rekamMedis,
            'pasien' => $pasien,
            'obat' => ObatModel::all()
        ];

        if ($gender == 'laki-laki' && $status_menikah == 'menikah') {
            $data['suamiIstri'] = IstriModel::where('id_pasien', $pasien->id)->first();
        } elseif ($gender == 'perempuan' && $status_menikah == 'menikah') {
            $data['suamiIstri'] = SuamiModel::where('id_pasien', $pasien->id)->first();
        } else {
            $data['suamiIstri'] = false;
        }

        return view('admin.obat.resep-create', $data);
    }

    function storeResep(Request $request)
    {
        $request->validate([
            'obat' => 'required',
            'jml_obat' => 'required',
            'keterangan' => 'required',
            'id_rekam_medis' => 'required'
        ]);

        // dd($request->all());

        // cek rekam medis
        $rekamMedis = RekamMedisModel::find(decryptStr($request->id_rekam_medis));
        if (!$rekamMedis) {
            Alert::error('Rekam medis tidak ditemuka!');
            return redirect()->back();
        }
        $id_pasien = $rekamMedis->id_pasien;

        $total_harga = 0;
        // cari obat
        foreach ($request->obat as $key => $value) {
            $obat = ObatModel::find(decryptStr($value));
            if (!$obat) {
                continue;
            }

            $id_obat = $obat->id;
            $harga = $obat->harga;
            // $total_harga = $harga * $request->jml_obat[$key];
            $data = [
                'id_obat' => $id_obat,
                'id_rekam_medis' => $rekamMedis->id,
                'id_pasien' => $id_pasien,
                'harga' => $harga,
                'jumlah' => $request->jml_obat[$key],
                'keterangan' => $request->keterangan[$key]
            ];

            // create obat keluar
            ObatKeluarModel::create($data);
        }


        // update status rekam medis
        if ($rekamMedis->status != 'di apotek') {
            Alert::error('Terjadi kesalahan!');
            return redirect()->back();
        }
        $rekamMedis->status = 'selesai';
        $rekamMedis->save();

        Alert::success('Pemberian resep dan obat berhasil!');

        return redirect('admin/obat/resep');
    }
}
