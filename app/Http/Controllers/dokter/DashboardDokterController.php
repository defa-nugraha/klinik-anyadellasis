<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDokterController extends Controller
{
    function index()
    {
        return view('dokter.dashboard.index');
    }
}
