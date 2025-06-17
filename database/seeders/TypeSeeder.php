<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    public function run()
    {
        Type::create(['name' => 'DNI', 'type_parent_id' => null]);
        Type::create(['name' => 'Pasaporte', 'type_parent_id' => null]);
        // Agrega más tipos si es necesario
    }
}
