<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function requestAid(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_type' => $request->order_type,
            'status' => 'requested',
        ]);

        return response()->json($order);
    }

    public function updateOrderStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $status]);

        return response()->json($order);
    }
}