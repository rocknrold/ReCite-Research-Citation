<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CrwSearchController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CrwCoreController;
use App\Http\Controllers\CrwWordController;
use App\Http\Controllers\CrwCoresSearchController;
use App\Http\Controllers\CrwCoreCitationController;
use App\Models\Crw_search;
use Illuminate\Support\Facades\Http;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/search?', [CrwSearchController::class, 'index'])->name('core.index');
Route::get('/search', [CrwSearchController::class, 'search'])->name('core.search');


Route::middleware(['direct.access'])->group(function () {
    Route::get('/search/library', [CrwCoreController::class, 'searchCoreLibrary']);
    Route::post('/search/library', [CrwCoreController::class, 'searchCoreLibrary'])->name('search.library');
    
    Route::get('/search/library-year', [CrwCoreController::class, 'filterYearSearch']);
    Route::post('/search/library-year', [CrwCoreController::class, 'filterYearSearch'])->name('search.libraryForYear');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/search/{word}/{id}', [CrwCoreController::class, 'nextPage'])->name('searchLibrary.next');
    Route::get('/search/{word}/{id}', [CrwCoreController::class, 'backPage'])->name('searchLibrary.back');
    Route::get('/core/like',[CrwCoresSearchController::class, 'corelikes'])->name('crw.likes');
});


Route::get('/add/library',[CrwCoresSearchController::class, 'addToLibrary'])->middleware('auth')->name('add.libary');
Route::get('/groups',[CrwCoresSearchController::class, 'groupsIndex'])->middleware('auth')->name('crw.index');

Route::get('/citations',[CrwCoreCitationController::class,'citationIndex'])->name('core.citation')->middleware('auth');
Route::get('/citation/list',[CrwCoreCitationController::class,'citationList'])->name('crw.citation');

Route::get('/word/list',[CrwWordController::class, 'showAll'])->name('words.list')->middleware('auth');

Route::get('/documentation', function(){
    return view('documentation');
});


// API ROUTES

Route::get('/api/GET/research/likes',[ApiController::class, 'getRL'])->name('getRL.api');