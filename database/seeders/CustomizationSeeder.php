<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customization;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon; // Make sure to import Carbon for date handling

class CustomizationSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Ensure a customer user exists
        $user = User::where('role', 'customer')->first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Customization Customer',
                'email' => 'customercustomization@example.com',
                'role' => 'customer',
                'password' => bcrypt('password'),
            ]);
        }

        // ✅ Ensure a customizable product exists
        $product = Product::where('is_customizable', true)->first();

        if (!$product) {
            $product = Product::factory()->create([
                'name' => 'Customizable Shirt',
                'code' => 'CS001',
                'retail_price' => 1200,
                'actual_price' => 1000,
                'quantity' => 10,
                'is_customizable' => true,
                'status' => 'active',
                'action' => 'available',
            ]);
        }

        // ✅ Create an order for this customer
        $order = Order::create([
            'user_id' => $user->id,
            'total' => 2400,

            // 👇 FIXED: Added the required delivery_address field
            'delivery_address' => 'House 456, Street 7, F-11/3, Islamabad, Pakistan',

            'status' => 'confirmed',
            'payment_status' => 'paid',
        ]);

        // ✅ Create an order item
        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => $product->retail_price,
            'subtotal' => 2 * $product->retail_price,
        ]);

        // ✅ Add customization for this order item
        Customization::create([
            'order_item_id' => $orderItem->id,
            'size' => 'Large',
            'fabric' => 'Cotton',
            'color' => 'Blue',

            // 👇 UPDATED: Added new fields from your migration
            'style_description' => 'Please add a pocket on the left side and make the collar stiff.',
            'reference_image_url' => 'Images/Women Casual Top.jpg',
            'delivery_date' => Carbon::now()->addWeek(), // Example: delivery in one week
        ]);
    }
}
