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
        $donation = null;
        $tracking = [];

        // Check if the request has data for donation
        if ($request->has('amount') && $request->has('payment_method')) {
            // Process the donation
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

        // Check if there's an order for social aid
        if ($request->has('order_type')) {
            // Process the aid request
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_type' => $request->order_type,
                'status' => 'requested',
            ]);

            // Store order success message in session and redirect
            return redirect()->route('donasi.index')
                           ->with('order_success', 'Pesanan Anda akan segera didistribusikan.');
        }

        return view('donasi.index', compact('donation', 'tracking'));
    }

    // This function handles the POST request for storing the donation and aid order
    public function store(Request $request)
    {
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

            // Store the donation details in the session
            session(['donation' => $donation]);

            // Redirect to the payment page after the donation has been stored
            return redirect()->route('payment.form');
        }

        // Process aid order request
        if ($request->has('order_type')) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_type' => $request->order_type,
                'status' => 'requested',
            ]);

            // Redirect with success message for order
            return redirect()->route('donasi.index')
                           ->with('order_success', 'Pesanan Anda akan segera didistribusikan.');
        }

        // If no specific data, redirect back to donasi page
        return redirect()->route('donasi.index');
    }

    // This function will display the payment method form
    public function showPaymentForm()
    {
        return view('payment.form');
    }

    // This function will handle the payment process
    public function processPayment(Request $request)
    {
        $donation = Donation::find($request->donation_id);
        if ($donation) {
            $donation->status = 'completed';
            $donation->save();
        }

        return redirect()->route('donasi.tracking', ['donation_id' => $donation->id])
                         ->with('success', 'Pembayaran berhasil. Terima kasih telah berdonasi!');
    }

    // Show the donation tracking page
    public function showTracking($donation_id)
    {
        $donation = Donation::findOrFail($donation_id);
        $tracking = DonationTracking::where('donation_id', $donation_id)->first();

        return view('donasi.tracking', compact('donation', 'tracking'));
    }

    // Show success page after donation and payment
    public function showSuccess()
    {
        return view('donasi.success');
    }
}