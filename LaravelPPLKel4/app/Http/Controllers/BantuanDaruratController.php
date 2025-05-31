<?php

namespace App\Http\Controllers;

class BantuanDaruratController extends Controller
{
    public function index()
    {
        $layout = auth()->user()->role === 'admin' ? 'admin.layouts.app' : 'layouts.app';
        return view('HalamanBantuanDarurat.BantuanDarurat', compact('layout'));
    }
}
