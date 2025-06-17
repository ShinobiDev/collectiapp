<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gender;

class GenderSeeder extends Seeder
{
    public function run()
    {
        Gender::create(['name' => 'Terror']);
        Gender::create(['name' => 'Romance']);
        Gender::create(['name' => 'Acción']);
    }
}
