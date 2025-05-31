<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class LaporanBanjir extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'lokasi',
        'deskripsi',
        'kontak',
        'foto',
        'status',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
