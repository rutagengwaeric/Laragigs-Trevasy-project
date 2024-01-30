<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Listing;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();

        $user = User::factory()->create([
             'name' => 'John Doa',
             'email' => 'John@gmail.com'

        ]);
         Listing::factory(6)->create([
            'user_id'=> $user->id
         ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Listing::create([
        //     'title' => 'Laravel senior Developer',
        //     'tags' => 'laravel , javascript',
        //     'company' => 'Binary corp',
        //     'location' => 'Kigali ,Rwanda',
        //     'email' => 'email@gmail.com',
        //     'website' => 'wewe.com',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.
        //     Vero dolore asperiores tenetur quae accusantium
        //    necessitatibus vitae hic dignissimos possimus minima!',

        // ]);
        // Listing::create([
        //     'title' => 'Full Stack Developer',
        //     'tags' => 'laravel , javascript , react ',
        //     'company' => 'Binary corp',
        //     'location' => 'Kigali ,Rwanda',
        //     'email' => 'email@gmail.com',
        //     'website' => 'wewe.com',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.
        //     Vero dolore asperiores tenetur quae accusantium
        //    necessitatibus vitae hic dignissimos possimus minima!',

        // ]);
    }
}

