<?php

namespace App\Http\Controllers;

use App\Models\CleaningRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    private const SERVICE_TYPES = [
        'home_cleaning' => 'Pembersihan Rumah',
        'office_cleaning' => 'Pembersihan Kantor',
        'furniture_cleaning' => 'Pembersihan Furnitur'
    ];

    /**
     * Display a listing of the orders for admin.
     */
    public function index()
    {
        $orders = CleaningRequest::latest()->get();
        
        $orders->each(function ($order) {
            $order->service_type_display = self::SERVICE_TYPES[$order->service_type] ?? ucwords(str_replace('_', ' ', $order->service_type));
            $order->status_message = 'Tim pembersih pasca banjir sedang menuju lokasi';
        });

        return view('orders.index', compact('orders'));
    }

    /**
     * Display a listing of the orders for users.
     */
    public function userIndex()
    {
        // For now, we'll get all orders. In a real application, you would filter by authenticated user
        $orders = CleaningRequest::latest()->get();
        
        $orders->each(function ($order) {
            $order->service_type_display = self::SERVICE_TYPES[$order->service_type] ?? ucwords(str_replace('_', ' ', $order->service_type));
        });

        return view('orders.index_user', compact('orders'));
    }
} 