<?php

namespace App\Http\Controllers;

use App\Models\CleaningRequest;
use Illuminate\Http\Request;

class CleaningRequestController extends Controller
{
    /**
     * Service pricing constants
     */
    private const PRICE_PER_SQM = [
        'home_cleaning' => 10000,     // Rp10.000 per m²
        'office_cleaning' => 12000,   // Rp12.000 per m²
        'furniture_cleaning' => 14000 // Rp14.000 per m²
    ];

    private const SERVICE_FEE = 8000; // Rp8.000
    private const TAX_RATE = 0.05;    // 5%

    /**
     * Service type mapping
     */
    private const SERVICE_TYPES = [
        'home_cleaning' => 'Home Cleaning',
        'office_cleaning' => 'Office Cleaning',
        'furniture_cleaning' => 'Furniture Cleaning'
    ];

    /**
     * Show the cleaning request creation form
     */
    public function create()
    {
        return view('cleaning-request.create', [
            'serviceTypes' => self::SERVICE_TYPES
        ]);
    }

    /**
     * Show the cleaning request form with pre-selected service
     */
    public function createWithService($service_type)
    {
        return view('cleaning-request.create', [
            'serviceTypes' => self::SERVICE_TYPES,
            'selectedService' => $service_type
        ]);
    }

    /**
     * Store a new cleaning request
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'full_address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'service_type' => 'required|in:' . implode(',', array_keys(self::SERVICE_TYPES)),
            'scheduled_datetime' => 'required|date',
            'payment_method' => 'required|string|max:255',
            'room_length' => 'required|numeric|min:0',
            'room_width' => 'required|numeric|min:0'
        ]);

        $prices = $this->calculatePrices(
            $validated['room_length'],
            $validated['room_width'],
            $validated['service_type']
        );

        $validated = array_merge($validated, $prices);

        CleaningRequest::create($validated);

        return redirect()->route('home')
            ->with('success', 'Cleaning request submitted successfully!');
    }

    /**
     * Calculate prices for the cleaning service
     */
    private function calculatePrices(float $length, float $width, string $serviceType): array
    {
        $area = $length * $width;
        $basePrice = self::PRICE_PER_SQM[$serviceType] * $area;
        $serviceFee = self::SERVICE_FEE;
        $tax = ($basePrice + $serviceFee) * self::TAX_RATE;

        return [
            'subtotal' => $basePrice,
            'service_fee' => $serviceFee,
            'tax' => $tax,
            'total' => $basePrice + $serviceFee + $tax
        ];
    }

    /**
     * API endpoint for price calculation
     */
    public function calculatePrice(Request $request)
    {
        $request->validate([
            'room_length' => 'required|numeric|min:0',
            'room_width' => 'required|numeric|min:0',
            'service_type' => 'required|in:' . implode(',', array_keys(self::SERVICE_TYPES))
        ]);

        $prices = $this->calculatePrices(
            $request->room_length,
            $request->room_width,
            $request->service_type
        );

        return response()->json(array_merge(
            ['area' => $request->room_length * $request->room_width],
            $prices
        ));
    }
}