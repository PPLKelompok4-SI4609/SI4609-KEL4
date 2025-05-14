<?php

namespace App\Http\Controllers;

use App\Models\CleaningRequest;
use Illuminate\Http\Request;

class CleaningRequestController extends Controller
{
    public function create()
    {
        $states = [
            'NY' => 'New York',
            'CA' => 'California',
            // Add more states as needed
        ];
        
        return view('cleaning-request.create', compact('states'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
            'zip_code' => 'required|string|max:10',
            'card_name' => 'required|string|max:255',
            'card_number' => 'required|string|max:16',
            'expiry_date' => 'required|string|max:7',
            'cvv' => 'required|string|max:4',
        ]);

        $validated['subtotal'] = 80.00;
        $validated['service_fee'] = 5.00;
        $validated['tax'] = 6.80;
        $validated['total'] = 91.80;

        CleaningRequest::create($validated);

        return redirect()->route('home')->with('success', 'Cleaning request submitted successfully!');
    }
}
