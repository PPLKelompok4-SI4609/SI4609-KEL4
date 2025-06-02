<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationTracking extends Model
{
    use HasFactory;

    protected $fillable = ['donation_id', 'tracking_info'];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
