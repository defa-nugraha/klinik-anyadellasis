<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanModel extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaan';

    protected $guarded = ['id'];

    public function rekam_medis()
    {
        return $this->belongsTo(RekamMedisModel::class, 'id_rekam_medis', 'id');
    }
}