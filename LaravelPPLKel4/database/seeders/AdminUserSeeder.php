<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@floodrescue.com'],
            [
                'name' => 'Admin FloodRescue',
                'password' => Hash::make('admin12345'),
                'phone_number' => '081234567890',
                'role' => 'admin',
                'two_factor_enabled' => false,
                'data_access_settings' => [
                    'can_manage_reports' => true,
                    'can_manage_users' => true,
                ],
                'email_verified_at' => now(),
            ]
        );
    }
}
