<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICDModel extends Model
{
    use HasFactory;

    protected $table = 'icd';

    protected $guarded = ['id'];
}
