<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;

class CollectionSeeder extends Seeder
{
    public function run()
    {
        Collection::create([
            'name' => 'Colección Clásicos',
            'category_id' => 1,
            'gender_id' => 1,
            'author_id' => 1,
            'editorial_id' => 1,
            'date' => '2020-01-01',
        ]);
        // Agrega más colecciones
    }
}
