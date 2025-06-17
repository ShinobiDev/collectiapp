<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        Author::create([
            'name' => 'Gabriel García Márquez',
            'birthday' => '1927-03-06',
        ]);
        // Agrega más autores si quieres
    }
}
