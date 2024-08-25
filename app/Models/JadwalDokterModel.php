<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalDokterModel extends Model
{
    use HasFactory;

    protected $table = 'jadwa_dokter';

    protected $guarded = ['id'];
}
