<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ObatKeluarModel;
use Illuminate\Http\Request;

class ObatKeluarAdminController extends Controller
{
    function index()
    {
        $data = [
            'obatkeluar' => ObatKeluarModel::orderBy('created_at', 'desc')->get()
        ];

        return view('admin.obat.riwayat.index', $data);
    }
}
