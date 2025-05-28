<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Order;
use App\Models\DonationTracking;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    // This function handles the display of the donation and order form
    public function index(Request $request)
    {
        $donation = null; // Initialize donation to avoid undefined variable error
        $tracking = [];   // Initialize tracking as an empty array

        // Check if the request has data for donation or aid order
        if ($request->has('amount') && $request->has('payment_method')) {
            // Process the donation
            $donation = Donation::create([
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'status' => 'pending', // Default status
            ]);

            // Simulate donation tracking
            $tracking = DonationTracking::create([
                'donation_id' => $donation->id,
                'tracking_info' => 'Donasi diterima dan sedang diproses.',
            ]);
        }

        // Check if there's an order for social aid
        if ($request->has('order_type')) {
            // Process the aid request
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_type' => $request->order_type,
                'status' => 'requested',
            ]);
        }

        // If already on 'donasi.index', render the view without redirect
        if (request()->is('donasi')) {
            return view('donasi.index', compact('donation', 'tracking'));
        }

        // Redirect back with success message and donation/tracking info if not on 'donasi.index'
        return redirect()->route('donasi.index')
                         ->with('success', 'Proses berhasil. Donasi dan pemesanan bantuan sosial telah diproses.')
                         ->with('donation', $donation) // Send donation data
                         ->with('tracking', $tracking); // Send tracking info if exists
    }

    // This function handles the POST request for storing the donation and aid order
    public function store(Request $request)
    {
        // Initialize donation variable to avoid errors
        $donation = null;
        $tracking = [];

        // Process the donation if data is available
        if ($request->has('amount') && $request->has('payment_method')) {
            $donation = Donation::create([
                'user_id' => auth()->id(),
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Simulate donation tracking
            $tracking = DonationTracking::create([
                'donation_id' => $donation->id,
                'tracking_info' => 'Donasi diterima dan sedang diproses.',
            ]);
        }

        // Handle aid order if available
        if ($request->has('order_type')) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_type' => $request->order_type,
                'status' => 'requested',
            ]);

            // Show a pop-up message after submitting the order
            session()->flash('order_success', 'Pesanan Anda akan segera didistribusikan.');
            return redirect()->route('donasi.index');
        }


        // Return view with donation and tracking info
        return redirect()->route('donasi.index')
                         ->with('success', 'Proses berhasil. Donasi dan pemesanan bantuan sosial telah diproses.')
                         ->with('donation', $donation) // Send donation info to the view
                         ->with('tracking', $tracking); // Send tracking info if exists
    }
}
