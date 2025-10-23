<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Dresses',
                'description' => 'Dresses for women.',
                'image' => 'admin/assets/images/logo/dress.jpg',
            ],
            [
                'name' => 'Tops',
                'description' => 'Tops for women.',
                'image' => 'admin/assets/images/logo/Tops.jpg',
            ],
            [
                'name' => 'Bottoms',
                'description' => 'Bottoms for women.',
                'image' => 'admin/assets/images/logo/Bottoms.jpg',
            ],
            [
                'name' => 'Footwear',
                'description' => 'Footwear for women.',
                'image' => 'admin/assets/images/logo/Footwear.jpg',
            ],
            [
                'name' => 'Accessories',
                'description' => 'Accessories for women.',
                'image' => 'admin/assets/images/logo/Accessories.jpg',
            ],
            [
                'name' => 'Winter Collection',
                'description' => 'Winter Collection for women.',
                'image' => 'admin/assets/images/logo/Winter Collection.jpg',
            ],
            [
                'name' => 'Summer Collection',
                'description' => 'Summer Collection for women.',
                'image' => 'admin/assets/images/logo/Summer Collection.webp',
            ],
        ];

        foreach ($categories as $data) {
            Category::create($data);
        }
    }
}
