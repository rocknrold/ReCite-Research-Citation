<?php

namespace App\Http\Controllers;

use App\Models\Crw_search;
use Illuminate\Http\Request;

class CrwSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function popularSearches()
    // {
    //     $popular = Crw_search::orderBy('search_frequency', 'DESC')
    //            ->take(5)
    //            ->get();
        
    //     $keywords = [];

    //     foreach($popular as $word)
    //     {
    //         $keywords[] = $word['search_keyword'];
    //     }
               
    //     return response()->json($keywords);
    // }
    public function index()
    {
        return view('core.index')->with('query', $request->query);
    }

    public function search(Request $request)
    {
        return view('core.index')->with('query', $request->query);
    }

}
