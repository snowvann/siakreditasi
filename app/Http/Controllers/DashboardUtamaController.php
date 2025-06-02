<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardUtamaController extends Controller
{
    public function index()
    {
        return view('dashboardUtama'); // Pastikan view ini ada di resources/views
    }
}
