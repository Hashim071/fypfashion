<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\User;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pehle user ko find karein (jise hum admin maan rahe hain)
        $user = User::find(1);

        if ($user) {
            Setting::updateOrCreate(
                ['user_id' => $user->id],

                [
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'phone' => '+92 300 1234567',
                    'address' => '123 Main Street, Islamabad, Pakistan',
                    'password' => null,
                ]
            );
        }
    }
}
