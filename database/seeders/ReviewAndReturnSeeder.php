<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\ReturnRequest;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Carbon\Carbon;

class ReviewAndReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ Ensure a customer exists
        $user = User::where('role', 'customer')->first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Customer User',
                'email' => 'customerreview@example.com',
                'role' => 'customer',
                'password' => bcrypt('password'), // test login
            ]);
        }

        // ✅ Ensure at least one product exists
        $product = Product::first();
        if (!$product) {
            $product = Product::create([
                'code' => 'P9999',
                'name' => 'Sample Product',
                'description' => 'Auto-generated test product for seeding reviews.',
                'category_id' => 1,
                'retail_price' => 1200,
                'actual_price' => 950,
                'quantity' => 10,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => true,
            ]);
        }

        // ✅ Ensure a completed order exists for this customer
        $order = Order::where('user_id', $user->id)->first();

        if (!$order) {
            $order = Order::create([
                'user_id' => $user->id,
                'total' => 2000,
                'delivery_address' => '123 Test Street, Lahore',
                'status' => 'completed',
                'payment_status' => 'paid',
                'payment_method' => 'cod',
            ]);
        }

        // ✅ Create Review if not already exists
        if (!Review::where('order_id', $order->id)->where('product_id', $product->id)->exists()) {
            Review::create([
                'order_id'   => $order->id,
                'user_id'    => $user->id,
                'product_id' => $product->id,
                'rating'     => 5,
                'comment'    => 'Excellent product quality! Highly recommended.',
            ]);
        }

        // ✅ Create Return Request if not already exists
        if (!ReturnRequest::where('order_id', $order->id)->exists()) {
            ReturnRequest::create([
                'order_id'    => $order->id,
                'user_id'     => $user->id,
                'reason'      => 'Product was slightly damaged on arrival.',
                'status'      => 'pending',
                'return_date' => Carbon::now()->addDays(2)->toDateString(),
            ]);
        }

        $this->command->info('✅ Review & Return data seeded successfully.');
    }
}
