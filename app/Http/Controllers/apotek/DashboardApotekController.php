<?php

namespace App\Http\Controllers\apotek;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardApotekController extends Controller
{
    function index()
    {
        return view('apotek.dashboard.index');
    }
}
