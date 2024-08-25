<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokterModel extends Model
{
    use HasFactory;

    protected $table = 'jadwal_dokter';

    protected $guarded = ['id'];

    public function dokter()
    {
        return $this->belongsTo(DokterModel::class, 'id_dokter', 'id');
    }
}
