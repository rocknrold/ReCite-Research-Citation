<?php

namespace App\Http\Controllers;

use App\Models\Crw_cores_search;
use App\Models\Crw_core;
use App\Models\Crw_core_citation;
use App\Models\Crw_search;
use Illuminate\Http\Request;

class CrwCoresSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function groupsIndex()
    {   
        $populars = Crw_search::popularSearches();
        $results = Crw_search::with(['coresearch'])
                            ->whereIn('search_keyword', $populars)
                            ->get();
               
        foreach($results as $search)
        { 
            $ids = []; 
            foreach($search->coresearch as $coreid)
            {
                $ids[] = $coreid->crw_coresID;
            }
            
            $cores = Crw_core::with(['corecitation'])->whereIn('core_id',$ids)->orderBy('likes', 'DESC')->get();
            $items[$search->search_keyword] = $cores;
        }
        // dd($items);
        return view('group.index')->with('items',$items);

    }

    public function addToLibrary(Request $request)
    {
        $search = Crw_search::where('search_keyword', $request->query('search'))->first();
        if($search)
        {
          $searchId = $search->search_id;
        }

        $coreId = Crw_core::addToCore(request()->title,request()->year,request()->doi,request()->url,request()->description);

        Crw_core_citation::addToCoreCitation($coreId,request()->doi);
        
        $coreSearch = Crw_cores_search::firstOrCreate(['crw_coresID'=>$coreId,'crw_searchesID'=>$searchId]);

        return redirect('/groups');
    }

    public function corelikes(Request $request)
    {
        if($request->ajax())
        {
            $core = Crw_core::corelikesupdate(key($request->all()),$request->get(key($request->all())));
        }
        return $core;
    }
}
