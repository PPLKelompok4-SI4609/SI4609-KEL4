<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CleaningRequest;
use Illuminate\Http\Request;

class AdminCleaningController extends Controller
{
    
    private const SERVICE_TYPES = [
        'home_cleaning' => 'Pembersihan Rumah',
        'office_cleaning' => 'Pembersihan Kantor',
        'furniture_cleaning' => 'Pembersihan Furnitur'
    ];

    public function index()
    {
        $orders = CleaningRequest::latest()->get();
        
        $orders->each(function ($order) {
            $order->service_type_display = self::SERVICE_TYPES[$order->service_type] ?? ucwords(str_replace('_', ' ', $order->service_type));
            $order->status_message = 'Tim pembersih pasca banjir sedang menuju lokasi';
        });

        return view('admin.pasca.index', compact('orders'));
    }

    public function destroy(CleaningRequest $order)
    {
        $order->delete();
        return back()->with('success', 'Pesanan berhasil dihapus.');
    }
}