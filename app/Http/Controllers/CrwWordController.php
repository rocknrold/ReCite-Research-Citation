<?php

namespace App\Http\Controllers;

use App\Models\Crw_word;
use App\Models\Crw_search;
use Illuminate\Http\Request;
use View;

class CrwWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $popularWords = Crw_search::popularSearches();

        foreach($popularWords as $pw)
        {
            $response = Crw_search::dictionaryLookup($pw);
            if(!array_key_exists('error',$response))
            {
                $results[$pw] = $response['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0];
                // $populars[] = $pw
            }
        }

        // $results = Crw_search::dictionaryLookup($popularWords[0]);
        // dd($results);
        // return view('word.index');
        return view('word.index')->with('words',$results);
    }
}
