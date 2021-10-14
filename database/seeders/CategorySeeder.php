<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Productos de madera',
                'slug' => Str::slug('Productos de madera'),
                'icon' => '<i class="fas fa-horse"></i>',
            ],
            [
                'name' => 'Productos textiles',
                'slug' => Str::slug('Productos textiles'),
                'icon' => '<i class="fas fa-tshirt"></i>',
            ],
            [
                'name' => 'Productos de barro',
                'slug' => Str::slug('Productos de barro'),
                'icon' => '<i class="fas fa-mug-hot"></i>',
            ],
            [
                'name' => 'Artesanias de palma',
                'slug' => Str::slug('Artesanias de palma'),
                'icon' => '<i class="fas fa-hat-cowboy"></i>',
            ],
            [
                'name' => 'Joyeria',
                'slug' => Str::slug('Joyeria'),
                'icon' => '<i class="fas fa-glasses"></i>',
            ],
        ];
        foreach ($categories as $category) {
            $category = Category::factory(1)->create($category)->first();
            $brands = Brand::factory(4)->create();
            foreach ($brands as $brand) {
                $brand->categories()->attach($category->id);
            }
        }
    }
}
