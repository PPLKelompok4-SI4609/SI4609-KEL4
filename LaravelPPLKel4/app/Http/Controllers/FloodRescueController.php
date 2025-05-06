<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\FloodRescueEduNotification;

class FloodRescueController extends Controller
{
    public function sendDummyNotification()
    {
        $users = User::all(); // Ambil semua pengguna
        foreach ($users as $user) {
            // Kirimkan notifikasi dummy
            $user->notify(new FloodRescueEduNotification("Ini adalah notifikasi dummy untuk pengujian."));
        }

        return response()->json(['message' => 'Notifikasi Dummy telah dikirim!']);
    }
}
