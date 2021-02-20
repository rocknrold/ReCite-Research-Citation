<?php
use Illuminate\Support\Facades\Http;

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CrwCoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $access_key = config('services.secrets.core');

        $response = Http::post('https://core.ac.uk:443/api-v2/search?apiKey='+ $access_key +'');


    }
}
