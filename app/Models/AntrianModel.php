<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianModel extends Model
{
    use HasFactory;

    protected $table = 'antrian';

    protected $guarded = ['id'];

    public function pasien()
    {
        return $this->belongsTo(PasienModel::class, 'id_pasien', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(DokterModel::class, 'id_dokter', 'id');
    }

    public function poli()
    {
        return $this->belongsTo(PoliModel::class, 'id_poli', 'id');
    }
}
