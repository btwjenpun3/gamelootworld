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
        // \App\Models\User::factory(10)->create();

        \App\Models\Role::create([
             'name' => 'admin'
         ]);

         \App\Models\Role::create([
             'name' => 'member'
         ]);

         \App\Models\User::create([
             'name' => 'Muhamad Helmi',
             'email' => 'muhamadkelmi@gmail.com',
             'password' => bcrypt('M3g4bl00d2018!@#'),
             'role_id' => 1
         ]);         
    }
}
