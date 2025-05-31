<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleaningRequest extends Model
{
    protected $fillable = [
        'full_name',
        'full_address',
        'contact_number',
        'service_type',
        'scheduled_datetime',
        'payment_method',
        'subtotal',
        'service_fee',
        'tax',
        'total',
        'estimated_duration'
    ];
}