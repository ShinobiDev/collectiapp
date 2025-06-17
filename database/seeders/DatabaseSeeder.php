<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StatusSeeder::class,
            TypeSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            AuthorSeeder::class,
            CategorySeeder::class,
            EditorialSeeder::class,
            GenderSeeder::class,
            CollectionSeeder::class,
            VolumeSeeder::class,
        ]);
    }
}
