<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\FloodRescueEduNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Notification;

class SendFloodRescueNotifications implements ShouldQueue
{
    use Dispatchable, Queueable;

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            // Kirimkan notifikasi ke pengguna
            $user->notify(new FloodRescueEduNotification($this->message));
        }
    }
}
