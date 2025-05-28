<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FloodZone;

class AdminMapController extends Controller
{
    public function index()
    {
        $floodZones = FloodZone::all();
        return view('admin.map.index', compact('floodZones'));
    }
}