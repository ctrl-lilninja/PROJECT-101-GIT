<?php

namespace App\Http\Controllers;
use App\Models\Bike;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        return view('dashboard');
    }
}

