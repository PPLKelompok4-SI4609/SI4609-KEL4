<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanBanjir;

class LaporanBanjirController extends Controller
{
    public function index()
    {
        $laporans = LaporanBanjir::where('user_id', auth()->id())->get();
        return view('laporan.status', compact('laporans'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kontak' => 'required|string|max:20',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format file tidak didukung. Hanya JPEG, PNG, JPG, dan GIF.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan_foto', 'public');
        }

        LaporanBanjir::create([
            'user_id' => auth()->id(),
            'nama' => $request->nama,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'kontak' => $request->kontak,
            'foto' => $fotoPath,
            'status' => 'Dikirim',
            'keterangan' => null
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim!');
    }
}
