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
        
        if ($request->status === 'Ditolak') {
            $laporan->keterangan = $request->keterangan;
            $laporan->save();

            return redirect()->route('admin.laporan.index')->with('success', 'Status laporan berhasil diperbarui dan keterangan laporan ditolak berhasil ditambahkan!');
        }

        $laporan->keterangan = null;
        $laporan->save();

        return redirect()->route('admin.laporan.index')->with('success', 'Status laporan berhasil diperbarui!');
    }
    
    public function destroy($id)
    {
        $laporan = LaporanBanjir::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
