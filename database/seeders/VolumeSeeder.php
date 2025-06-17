<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Volume;

class VolumeSeeder extends Seeder
{
    public function run()
    {
        Volume::create([
            'name' => 'Volumen 1',
            'collection_id' => 1,
        ]);
        Volume::create([
            'name' => 'Volumen 2',
            'collection_id' => 1,
        ]);
        // Añade más volúmenes si quieres
    }
}
