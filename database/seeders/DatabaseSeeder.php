<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            CustomizationSeeder::class,
            ReviewAndReturnSeeder::class,
            SettingSeeder::class,
            BlogSeeder::class,
        ]);
    }
}
