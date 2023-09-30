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
             'password' => bcrypt('123456'),
             'role_id' => 1,
             'status' => 'active'
         ]);   
         
        \App\Models\Platform::factory(18)
                ->sequence(
                    ['name' => 'PC', 'slug' => 'pc'],  
                    ['name' => 'Steam', 'slug' => 'steam'],
                    ['name' => 'GOG', 'slug' => 'gog'],
                    ['name' => 'Epic Games Store', 'slug' => 'epic-games-store'],
                    ['name' => 'Ubisoft', 'slug' => 'ubisoft'],
                    ['name' => 'Itch.io', 'slug' => 'itch-io'],
                    ['name' => 'Playstation 4', 'slug' => 'playstation-4'],
                    ['name' => 'Playstation 5', 'slug' => 'playstation-5'],    
                    ['name' => 'Xbox One', 'slug' => 'xbox-one'], 
                    ['name' => 'Xbox 360', 'slug' => 'xbox-360'],
                    ['name' => 'Xbox Series X|S', 'slug' => 'xbox-series-xs'],
                    ['name' => 'Switch', 'slug' => 'switch'],
                    ['name' => 'Android', 'slug' => 'android'],
                    ['name' => 'iOS', 'slug' => 'ios'],
                    ['name' => 'VR', 'slug' => 'vr'],  
                    ['name' => 'Battle.net', 'slug' => 'battle-net'],
                    ['name' => 'Origin', 'slug' => 'origin'],
                    ['name' => 'DRM-Free', 'slug' => 'drm-free'],
                )
                ->create();;
    }
}
