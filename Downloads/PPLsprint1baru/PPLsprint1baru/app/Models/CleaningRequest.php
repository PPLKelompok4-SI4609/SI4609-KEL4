<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CleaningRequest extends Model
{
    protected $fillable = [
        'full_name',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'zip_code',
        'card_name',
        'card_number',
        'expiry_date',
        'cvv',
        'subtotal',
        'service_fee',
        'tax',
        'total'
    ];
}
