<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status; // Importa el modelo

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::create(['name' => 'Activo']);
        Status::create(['name' => 'Inactivo']);
    }
}
