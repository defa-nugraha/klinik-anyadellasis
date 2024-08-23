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
        if ($role == 1) {
            // superadmin
            return redirect()->route('admin.dashboard');
        } elseif ($role == 2) {
            // admin keuangan
            return redirect()->route('admin-keuangan.dashboard');
        } elseif ($role == 3) {
            // customer
            return redirect()->route('user.dashboard');
        }

        return redirect()->route('login');
    }
}
