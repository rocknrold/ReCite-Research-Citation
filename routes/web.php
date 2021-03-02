<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CrwSearchController;
use App\Http\Controllers\CrwCoreController;
use App\Http\Controllers\CrwWordController;
use App\Models\Crw_search;

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
    $popular = Crw_search::popularSearches();

    return view('layouts.home', ['popular' => $popular]);
});

Route::get('/core/{keyword}', function(Request $request, $keyword){
   
    $access_key = config('services.secrets.core');

    $query = "title:($keyword)";

    $response = Http::post('https://core.ac.uk:443/api-v2/search?apiKey='. $access_key .'',[
            ["query" => $query,
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

})->name('word.api');


Route::get('/search?', [CrwSearchController::class, 'index'])->name('core.index');
Route::get('/search', [CrwSearchController::class, 'search'])->name('core.search');

Route::post('/search/library', [CrwCoreController::class, 'searchCoreLibrary'])->name('search.library');
Route::post('/search/library-year', [CrwCoreController::class, 'filterYearSearch'])->name('search.libraryForYear');
Route::get('/search/{word}/{id}', [CrwCoreController::class, 'nextPage'])->name('searchLibrary.next');
Route::get('/search/{word}/{id}', [CrwCoreController::class, 'backPage'])->name('searchLibrary.back');

Route::get('/word/list',[CrwWordController::class, 'showAll'])->name('words.list');

// Route::get('/search/{word}/{id}', function($word, $id){
//     return $word . ' ' . $id . '';
// })->name('seachLibrary.next');

