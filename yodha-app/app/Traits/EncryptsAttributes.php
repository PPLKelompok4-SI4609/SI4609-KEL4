<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait EncryptsAttributes
{
    protected $encryptable = [
        'name',
        'phone_number',
        'email'
    ];

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        
        if (in_array($key, $this->encryptable) && !is_null($value)) {
            return Crypt::decryptString($value);
        }
        
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable) && !is_null($value)) {
            $value = Crypt::encryptString($value);
        }

        return parent::setAttribute($key, $value);
    }
}