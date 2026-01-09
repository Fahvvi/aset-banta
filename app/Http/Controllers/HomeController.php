<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    // Ambil 10 alat terbaru
    $assets = \App\Models\Asset::latest()->take(10)->get();
    return view('welcome', compact('assets'));
}
}
