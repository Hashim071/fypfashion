<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch all categories (create one if none exist)
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $categories = collect([
                Category::create([
                    'name' => 'Default Category',
                    'description' => 'Auto-created default category for products',
                    'image' => 'categories/default.jpg',
                ]),
            ]);
        }

        // ✅ Define a standard set of customization fields for reusable code
        $customFields = [
            [
                'name' => 'size',
                'label' => 'Select Your Size',
                'type' => 'select',
                'options' => ['Small', 'Medium', 'Large', 'Extra-Large']
            ],
            [
                'name' => 'fabric',
                'label' => 'Choose Fabric',
                'type' => 'select',
                'options' => ['Cotton', 'Silk', 'Linen', 'Chiffon']
            ],
            [
                'name' => 'color',
                'label' => 'Preferred Color',
                'type' => 'text',
                'placeholder' => 'e.g., Royal Blue, Ruby Red'
            ],
            [
                'name' => 'style_description',
                'label' => 'Style Notes / Instructions',
                'type' => 'textarea',
                'placeholder' => 'Any special requests? e.g., "Add pockets", "Sleeveless"'
            ],
            [
                'name' => 'reference_image',
                'label' => 'Upload a Reference Image (Optional)',
                'type' => 'file'
            ]
        ];

        // Product data with descriptions
        $products = [
            [
                'code' => 'P1001',
                'name' => 'Women Summer Dress',
                'description' => 'Lightweight cotton summer dress with floral patterns — perfect for casual outings and warm weather.',
                'image' => 'admin/assets/images/logo/Women Summer Dress.jpg',
                'retail_price' => 2500,
                'actual_price' => 1800,
                'quantity' => 20,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => true,
            ],
            [
                'code' => 'P1002',
                'name' => 'Women Casual Top',
                'description' => 'Stylish casual top made from soft rayon fabric, available in multiple colors and perfect for daily wear.',
                'image' => 'admin/assets/images/logo/Women Casual Top.jpg',
                'retail_price' => 1200,
                'actual_price' => 900,
                'quantity' => 15,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => true,
            ],
            [
                'code' => 'P1003',
                'name' => 'Women Handbag',
                'description' => 'Elegant leather handbag with golden straps, ideal for parties and formal occasions.',
                'image' => 'admin/assets/images/logo/Women Handbag.jpg',
                'retail_price' => 3500,
                'actual_price' => 2700,
                'quantity' => 10,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => false,
            ],
            [
                'code' => 'P1004',
                'name' => 'Elegant Party Dress',
                'description' => 'Beautiful evening dress with a custom-fit design. Features satin finish and lace detailing.',
                'image' => 'admin/assets/images/logo/Elegant Party Dress.jpg',
                'retail_price' => 4800,
                'actual_price' => 4200,
                'quantity' => 8,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => true,
            ],
            [
                'code' => 'P1005',
                'name' => 'Stylish Women Footwear',
                'description' => 'Trendy high-heel sandals crafted with durable sole and elegant straps for comfort and style.',
                'image' => 'admin/assets/images/logo/Stylish Women Footwear.jpg',
                'retail_price' => 3200,
                'actual_price' => 2500,
                'quantity' => 18,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => false,
            ],
            [
                'code' => 'P1006',
                'name' => 'Women Denim Jeans',
                'description' => 'Classic blue denim jeans with stretchable fabric. Comfortable and available in multiple sizes.',
                'image' => 'admin/assets/images/logo/Women Denim Jeans.webp',
                'retail_price' => 2800,
                'actual_price' => 2300,
                'quantity' => 25,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => true,
            ],
            [
                'code' => 'P1007',
                'name' => 'Trendy Sunglasses',
                'description' => 'UV-protected sunglasses with stylish black frames — adds a chic touch to any outfit.',
                'image' => 'admin/assets/images/logo/Trendy Sunglasses.jpg',
                'retail_price' => 1800,
                'actual_price' => 1300,
                'quantity' => 30,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => false,
            ],
            [
                'code' => 'P1008',
                'name' => 'Women Winter Jacket',
                'description' => 'Warm and cozy jacket made from high-quality wool. Perfect for winter evenings and travel.',
                'image' => 'admin/assets/images/logo/Women Winter Jacket.jpg',
                'retail_price' => 5500,
                'actual_price' => 4700,
                'quantity' => 12,
                'status' => 'active',
                'action' => 'available',
                'is_customizable' => true,
            ],
        ];

        foreach ($products as $productData) {
            $productData['category_id'] = $categories->random()->id;

            if ($productData['is_customizable']) {
                $productData['customization_fields'] = $customFields;
            }

            Product::updateOrCreate(
                ['code' => $productData['code']],
                $productData
            );
        }
    }
}
