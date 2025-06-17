<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Editorial;

class EditorialSeeder extends Seeder
{
    public function run()
    {
        Editorial::create(['name' => 'Planeta']);
        Editorial::create(['name' => 'Penguin Random House']);
    }
}
