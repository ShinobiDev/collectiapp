<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Literatura']);
        Category::create(['name' => 'Ciencia ficción']);
        // Más categorías si deseas
    }
}
