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

   $myreq = "title:(web scrape or web) AND year:2019";


    $response = Http::get('https://core.ac.uk:443/api-v2/search/title%3A%22web%20content%20analysis%22%20AND%20year%3A2019?page=1&pageSize=10&apiKey='. config('services.secrets.core').'');

    dd($response->json());

    return $response->json();
    
})->name('core.api');