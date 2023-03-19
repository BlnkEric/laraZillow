<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
        ->has(Listing::factory()->count(10), 'listings')
        ->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
        ]);

        \App\Models\User::factory(10)->create();

        // $user = User::factory(10)
        //     ->has(Listing::factory()->count(3), 'listings')
        //     ->create();

        $this->call([
            ListingSeeder::class,
        ]);
    }
}
