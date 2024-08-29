<?php

namespace App\Http\Controllers\nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardNurseController extends Controller
{
    function index()
    {
        return view('nurse.dashboard.index');
    }
}
