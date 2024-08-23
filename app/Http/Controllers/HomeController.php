<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->role;
        // dd($role);
        if ($role == 'admin') {
            // superadmin
            return redirect()->route('admin.dashboard');
        } elseif ($role == 'doctor') {
            // dokter
            return redirect()->route('doctor.dashboard');
        } elseif ($role == 'nurse') {
            // nurse
            return redirect()->route('nurse.dashboard');
        } elseif ($role == 'patient') {
            // patient
            return redirect()->route('patient.dashboard');
        }

        return redirect()->route('login');
    }
}
