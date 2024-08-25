<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranModel extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function poli()
    {
        return $this->belongsTo(PoliModel::class, 'id_poli', 'id');
    }

    public function pasien()
    {
        return $this->belongsTo(PasienModel::class, 'id_pasien', 'id');
    }
}
