<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'order'             => 'A1',
            'name'              => 'Fundas para Robot',
            'image'             => 'images/category/noun-robotic-arm-44544132.png',
            'has_subcategory'   => 1,
        ]);

        Category::create([
            'order'             => 'A2',
            'name'              => 'Paños de limpieza',
            'image'             => 'images/category/noun-clean-39398201.png',
            'has_subcategory'   => 1,
        ]);

        Category::create([
            'order'             => 'A3',
            'name'              => 'Protección de piezas',
            'image'             => 'images/category/noun-door-8093061.png',
            'has_subcategory'   => 1,
        ]);

        Category::create([
            'order'             => 'A4',
            'name'              => 'Insumos areas limpias',
            'image'             => 'images/category/noun-mask-33775561.png',
            'has_subcategory'   => 1,
        ]);

        Category::create([
            'order'             => 'A5',
            'name'              => 'Indumentaria',
            'image'             => 'images/category/noun-jacket-13588701.png',
            'has_subcategory'   => 1,
        ]);

        Category::create([
            'order'             => 'A6',
            'name'              => 'Protección respiratoria',
            'image'             => 'images/category/noun-respiratory-mask-46859921.png',
            'has_subcategory'   => 1,
        ]);

    }
}
