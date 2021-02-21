<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Crw_search;

class CrwWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (Crw_search::all() as $index) {
	        DB::table('crw_words')->insert([
                'crw_searchID' => $index['search_id'],
                'crw_description' => $faker->text,
                'crw_synonym' => $faker->word,
                'created_at' => now(),
	        ]);
	    }
    }
}
