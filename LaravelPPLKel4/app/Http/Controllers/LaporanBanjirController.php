<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanBanjir;

class LaporanBanjirController extends Controller
{
    public function create()
    {
        return view('laporan_banjir.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kontak' => 'required|string|max:20',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan_foto', 'public');
        }

        LaporanBanjir::create([
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'kontak' => $request->kontak,
            'foto' => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }
}
