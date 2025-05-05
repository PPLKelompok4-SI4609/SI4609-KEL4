<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LaporanBanjir;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $laporans = LaporanBanjir::latest()->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $laporan = LaporanBanjir::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return redirect()->route('admin.laporan.index')->with('success', 'Status laporan berhasil diperbarui!');
    }
}
