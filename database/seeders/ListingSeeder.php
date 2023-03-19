<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Listing::factory(20)->create([
        //     'by_user_id' => User::inRandomOrder()->first()->id
        // ]);

        // Listing::factory()
        //             ->count(20)
        //             ->make()
        //             ->each();

        $listings = Listing::factory(20)->make();

        foreach ($listings as $key => $listing) {
            $listing->by_user_id = User::inRandomOrder()->first()->id;
            $listing->save();
        }
    }
}
