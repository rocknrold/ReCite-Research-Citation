<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CrwSearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('crw_searches')->insert([
                'search_keyword' => $faker->word,
                'search_frequency' => $faker->numberBetween(10,90),
                'created_at' => now(),
	        ]);
	    }
    }
}
