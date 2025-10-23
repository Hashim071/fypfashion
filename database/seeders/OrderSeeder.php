<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Ensure a customer user exists (not admin)
        $user = User::where('role', 'customer')->first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Demo Customer',
                'email' => 'customer@example.com',
                'role' => 'customer',
                'password' => bcrypt('password'), // test login
            ]);
        }

        // ✅ Ensure at least 2 products exist
        $products = Product::take(2)->get();

        if ($products->count() < 2) {
            $products = collect([
                Product::factory()->create([
                    'name' => 'Test Product A',
                    'code' => 'TPA001',
                    'retail_price' => 500,
                    'actual_price' => 400,
                    'quantity' => 20,
                    'is_customizable' => true,
                    'status' => 'active',
                    'action' => 'available',
                ]),
                Product::factory()->create([
                    'name' => 'Test Product B',
                    'code' => 'TPB002',
                    'retail_price' => 800,
                    'actual_price' => 600,
                    'quantity' => 15,
                    'is_customizable' => false,
                    'status' => 'active',
                    'action' => 'available',
                ]),
            ]);
        }

        // ✅ Calculate total dynamically
        $total = (2 * $products[0]->retail_price) + (1 * $products[1]->retail_price);

        // ✅ Create an order for customer only
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,

            // 👇 UPDATED: Added delivery_address
            'delivery_address' => 'House 123, Street 4, G-10/2, Islamabad, Pakistan',

            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        // ✅ Add order items
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $products[0]->id,
            'quantity' => 2,
            'price' => $products[0]->retail_price,
            'subtotal' => 2 * $products[0]->retail_price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $products[1]->id,
            'quantity' => 1,
            'price' => $products[1]->retail_price,
            'subtotal' => 1 * $products[1]->retail_price,
        ]);
    }
}
