<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $subcategories = [
            /*Productos de madera*/
            [
                'category_id' => 1,
                'name' => 'Juguetes',
                'slug' => Str::slug('Juguetes'),
                'color' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Utensilios de cocina',
                'slug' => Str::slug('Utensilios de cocina'),
            ],
            [
                'category_id' => 1,
                'name' => 'Esculturas',
                'slug' => Str::slug('Esculturas'),
                
            ],
            /*Productos textiles*/
            [
                'category_id' => 2,
                'name' => 'Ropa para dama',
                'slug' => Str::slug('Ropa para dama'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Ropa para caballero',
                'slug' => Str::slug('Ropa para caballero'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Ropa infantil',
                'slug' => Str::slug('Ropa infantil'),
                'color' => true,
                'size' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Accesorios',
                'slug' => Str::slug('Accesorios'),
            ],
            [
                'category_id' => 2,
                'name' => 'Textiles',
                'slug' => Str::slug('Textiles'),
            ],
            /*Productos de barro*/
            [
                'category_id' => 3,
                'name' => 'Jarrones y demas utensilios',
                'slug' => Str::slug('Jarrones y demas utensilios'),
            ],
            [
                'category_id' => 3,
                'name' => 'Esculturas y decoración',
                'slug' => Str::slug('Esculturas y decoracion'),
                'color' => true,
            ],
            /*Artesanias de palma*/
            [
                'category_id' => 4,
                'name' => 'Sombreros',
                'slug' => Str::slug('Sombreros'),
                'color' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Bolsos, morrales y canastas',
                'slug' => Str::slug('Bolsos morrales y canastas'),
                'color' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Utensilios',
                'slug' => Str::slug('Utensilios'),
                'color' => true,
            ],
            /*Joyeria */
            [
                'category_id' => 5,
                'name' => 'Accesorios',
                'slug' => Str::slug('Accesorios'),
            ],
            [
                'category_id' => 5,
                'name' => 'Damas',
                'slug' => Str::slug('Damas'),
                'color' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Caballeros',
                'slug' => Str::slug('Caballeros'),
                'color' => true,
            ],
        ];
        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }
    }
}
