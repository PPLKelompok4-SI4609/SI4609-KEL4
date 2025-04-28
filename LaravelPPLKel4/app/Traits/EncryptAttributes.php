<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait EncryptAttributes
{
    /**
     * Mengambil nilai atribut dari model.
     *
     * @param string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        
        if (in_array($key, $this->encryptable ?? [])) {
            try {
                return !empty($value) ? Crypt::decryptString($value) : $value;
            } catch (\Exception $e) {
                return $value;
            }
        }
        
        return $value;
    }

    /**
     * Mengatur nilai atribut pada model.
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable ?? [])) {
            try {
                $value = !empty($value) ? Crypt::encryptString($value) : $value;
            } catch (\Exception $e) {
                // Handle atau log error jika diperlukan
            }
        }

        return parent::setAttribute($key, $value);
    }
}