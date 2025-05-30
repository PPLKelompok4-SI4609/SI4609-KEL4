<?php

namespace App\Http\Controllers;

use App\Models\CleaningRequest;
use Illuminate\Http\Request;

class CleaningRequestController extends Controller
{
    
    private const PRICE_PER_SQM = [
        'home_cleaning' => 10000,     
        'office_cleaning' => 12000,   
        'furniture_cleaning' => 14000 
    ];

   
    private const CLEANING_RATE_SQM_PER_HOUR = [
        'home_cleaning' => 20,     
        'office_cleaning' => 15,   
        'furniture_cleaning' => 10 
    ];

    private const SERVICE_FEE = 8000; 
    private const TAX_RATE = 0.05;    

    
    private const SERVICE_TYPES = [
        'home_cleaning' => 'Pembersihan Rumah',
        'office_cleaning' => 'Pembersihan Kantor',
        'furniture_cleaning' => 'Pembersihan Furnitur'
    ];

    
    public function create()
    {
        return view('cleaning-request.create', [
            'serviceTypes' => self::SERVICE_TYPES
        ]);
    }

    
    public function createWithService($service_type)
    {
        return view('cleaning-request.create', [
            'serviceTypes' => self::SERVICE_TYPES,
            'selectedService' => $service_type
        ]);
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'full_address' => 'required|string|max:255',
            'contact_number' => 'required|string|max:20',
            'service_type' => 'required|in:' . implode(',', array_keys(self::SERVICE_TYPES)),
            'payment_method' => 'required|string|max:255',
            'room_length' => 'required|numeric|min:0',
            'room_width' => 'required|numeric|min:0',
            'subtotal' => 'required|numeric|min:0',
            'service_fee' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'estimated_duration' => 'required|integer|min:1',
            'scheduled_datetime' => 'required|date'
        ]);

        $order = CleaningRequest::create($validated);

        return redirect()->route('cleaning-request.confirmation', $order)
            ->with('success', 'Order placed successfully!');
    }

    
    public function confirmation(CleaningRequest $order)
    {
        return view('cleaning-request.confirmation', compact('order'));
    }

    
    private function calculatePrices(float $length, float $width, string $serviceType): array
    {
        $area = $length * $width;
        $basePrice = self::PRICE_PER_SQM[$serviceType] * $area;
        $serviceFee = self::SERVICE_FEE;
        $tax = ($basePrice + $serviceFee) * self::TAX_RATE;

        
        $estimatedHours = ceil($area / self::CLEANING_RATE_SQM_PER_HOUR[$serviceType]);

        return [
            'area' => $area,
            'subtotal' => $basePrice,
            'service_fee' => $serviceFee,
            'tax' => $tax,
            'total' => $basePrice + $serviceFee + $tax,
            'estimated_duration' => $estimatedHours
        ];
    }

    
    public function calculatePrice(Request $request)
    {
        $request->validate([
            'room_length' => 'required|numeric|min:0',
            'room_width' => 'required|numeric|min:0',
            'service_type' => 'required|in:' . implode(',', array_keys(self::SERVICE_TYPES))
        ]);

        return response()->json($this->calculatePrices(
            $request->room_length,
            $request->room_width,
            $request->service_type
        ));
    }
}