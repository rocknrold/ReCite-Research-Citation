<?php

namespace App\Http\Controllers;

use App\Models\Crw_cores_search;
use App\Models\Crw_core;
use App\Models\Crw_core_citation;
use App\Models\Crw_search;
use App\Models\User;
use App\Models\Crw_usercore_view;
use Illuminate\Http\Request;
use DB;

class CrwCoresSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function groupsIndex()
    // {   
    //     $populars = Crw_search::popularSearches();
    //     $results = Crw_search::with(['coresearch'])
    //                         ->whereIn('search_keyword', $populars)
    //                         ->get();
               
    //     foreach($results as $search)
    //     { 
    //         $ids = []; 
    //         foreach($search->coresearch as $coreid)
    //         {
    //             $ids[] = $coreid->crw_coresID;
    //         }
            
    //         $cores = Crw_core::with(['corecitation'])->whereIn('core_id',$ids)->whereIn('visibility', ['public'])->orderBy('likes', 'DESC')->get();
    //         $items[$search->search_keyword] = $cores;
    //     }
    //     if(empty($items))
    //     {
    //         $items['error'] = "no groups yet";
    //     }
    //     return view('group.index')->with('items',$items);

    // }
    public function groupsIndex()
    {   
        $result = User::with(['usercore'])->paginate(10);
        return view('group.index')->with('items',$result);

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

        return redirect('/profile/library/collections/');
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
