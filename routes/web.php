<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/core', function(){
   
    $access_key = config('services.secrets.core');

    $response = Http::post('https://core.ac.uk:443/api-v2/search?apiKey='. $access_key .'',[
            ["query" => "title:(web content analysis for ads) AND year:2021",
            "page" => 1,
            "pageSize" => 10,
            "scrollId" => "",]
        ]);
    

    dd($response->json());

    return $response->json();

})->name('core.api');


Route::get('/word', function(){
   
    $access_key = config('services.secrets.word');
    $app_id = config('services.secrets.wordapp');
    
    $response = Http::withHeaders([
            "Accept" => "application/json",
            "app_id" => $app_id,
            "app_key"=> $access_key
    ])->get('https://od-api.oxforddictionaries.com/api/v2/entries/en-gb/ace?strictMatch=false');

    dd($response->json());

    return $response->json();

})->name('core.api');