<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedisModel extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $guarded = ['id'];

    public function dokter()
    {
        return $this->belongsTo(DokterModel::class, 'id_dokter', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo(PasienModel::class, 'id_pasien', 'id');
    }

    public function poli()
    {
        return $this->belongsTo(PoliModel::class, 'id_poli', 'id');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranModel::class, 'id_pendaftaran', 'id');
    }

    public function riwayat_persalinan()
    {
        return $this->belongsTo(RekamMedisKandunganModel::class, 'id_rm_kandungan', 'id');
    }

    public function tindakan()
    {
        return $this->belongsTo(TindakanModel::class, 'id_tindakan', 'id');
    }

    public function diagnosa()
    {
        return $this->belongsTo(DiagnosaModel::class, 'id_diagnosa', 'id');
    }

    public function pemeriksaan()
    {
        return $this->belongsTo(PemeriksaanModel::class, 'id_pemeriksaan', 'id');
    }
}
