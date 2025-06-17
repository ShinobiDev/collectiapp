<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'type_document_id' => 1,
            'document' => '12345678',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'birthday' => '1990-01-01',
            'role_id' => 1,
            'status_id' => 1,
        ]);
        // Puedes agregar otros usuarios
    }
}
