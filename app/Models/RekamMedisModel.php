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

    public function pendaftaran()
    {
        return $this->belongsTo(PendaftaranModel::class, 'id_pendaftaran', 'id');
    }
}
