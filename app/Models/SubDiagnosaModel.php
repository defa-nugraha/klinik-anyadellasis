<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDiagnosaModel extends Model
{
    use HasFactory;

    protected $table = 'sub_diagnosa';
    protected $guarded = ['id'];

    public function diagnosa()
    {
        return $this->belongsTo(DiagnosaModel::class, 'id_diagnosa', 'id');
    }

    public function icd()
    {
        return $this->belongsTo(ICDModel::class, 'id_icd', 'id');
    }
}
