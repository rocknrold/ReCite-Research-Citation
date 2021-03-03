<?php

namespace App\Http\Controllers;

use App\Models\Crw_cores_search;
use App\Models\Crw_core;
use App\Models\Crw_search;
use Illuminate\Http\Request;

class CrwCoresSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addToLibrary(Request $request)
    {
        $search = Crw_search::where('search_keyword', $request->get('query') )->first();
        $searchId = $search->search_id;

        // dd([$search,$searchId]);

        $coreId = Crw_core::addToCore(request()->title,request()->year,request()->oai,request()->url,request()->description);
        
        $coreSearch = Crw_cores_search::firstOrCreate(['crw_coresID'=>$coreId,'crw_searchesID'=>$searchId]);

        dd([$search,$searchId,$coreId,$coreSearch]);

        // dd([$request->query('title'),$request->get('title'),request()->title, $request->all(),$request->query('url'),$request->get('description')]);
    }

}
