<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuamiModel extends Model
{
    use HasFactory;

    protected $table = 'suami';

    protected $guarded = ['id'];

    public function pasien()
    {
        return $this->belongsTo(PasienModel::class, 'id_pasien', 'id');
    }
}
