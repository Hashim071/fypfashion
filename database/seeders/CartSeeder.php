<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CartItem;
use App\Models\User;
use App\Models\Product;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ Ensure a customer user exists
        $user = User::where('role', 'customer')->first();

        if (!$user) {
            $user = User::factory()->create([
                'role' => 'customer',
                'email' => 'customercart@example.com',
                'password' => bcrypt('password'), // test login
            ]);
        }

        // ✅ Ensure at least 1 active product exists
        $product = Product::where('status', 'active')->first();

        if (!$product) {
            $product = Product::factory()->create([
                'name' => 'Test Product',
                'code' => 'TP001',
                'retail_price' => 500,
                'actual_price' => 400,
                'quantity' => 10,
                'status' => 'active',
                'action' => 'available',
            ]);
        }

        // ✅ Clear old cart items for clean seeding
        CartItem::where('user_id', $user->id)->delete();

        // ✅ Create dummy cart items for this customer
        CartItem::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 2,
            'price'      => $product->retail_price,
        ]);

        CartItem::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 1,
            'price'      => $product->retail_price,
        ]);
    }
}
