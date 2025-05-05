<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< Updated upstream:yodha-app/app/Models/User.php
use App\Traits\EncryptsAttributes;
=======
use App\Traits\EncryptAttributes;
>>>>>>> Stashed changes:LaravelPPLKel4/app/Models/User.php

class User extends Authenticatable
{
    use Notifiable, EncryptAttributes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'two_factor_enabled',
        'data_access_settings'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_code',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_expires_at' => 'datetime',
        'data_access_settings' => 'array',
    ];

    public function generateTwoFactorCode()
    {
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
        
        \Mail::to($this->email)->send(new \App\Mail\TwoFactorCode($this->two_factor_code));
        \Log::info('Two Factor Code generated for user: ' . $this->email . ' - Code: ' . $this->two_factor_code);
    }

    public function resetTwoFactorCode()
    {
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }
}
