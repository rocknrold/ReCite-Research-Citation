<?php

namespace App\Http\Controllers;

use App\Models\Crw_core;
use App\Models\Crw_search;
use App\Models\Crw_word;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;

class CrwCoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCoreLibrary(Request $request)
    {
        if(request()->isMethod('GET')){
            return abort(404);
        }else {

        $keyword= request()->post('query');

        $access_key = config('services.secrets.core');

        $query = "title:($keyword)";
    
        $response = Http::post('https://core.ac.uk:443/api-v2/search?apiKey='. $access_key .'',[
                ["query" => $query,
                "page" => 1,
                "pageSize" => 100,
                "scrollId" => "",]
            ]);
    
        $dictionaryLookup = Crw_search::dictionaryLookup($keyword);

        $validateWord = Crw_search::checkUserWord($keyword, $dictionaryLookup);

        $validateCore = Crw_core::validateLibraryResponse($response->json());

        if($validateCore)
        {
            if($validateWord)
            {
                $searchesId = Crw_search::saveSearch($keyword);
                
                $words = $dictionaryLookup['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0];

                if(array_key_exists('definitions', $words))
                {
                    $wordDescription = $dictionaryLookup['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['definitions'][0];    
                }else { $wordDescription = $keyword;}
    
                if(array_key_exists('synonyms', $words))
                {
                    $wordSynonym = $dictionaryLookup['results'][0]['lexicalEntries'][0]['entries'][0]['senses'][0]['synonyms'][0]['text'];
                }else { $wordSynonym = $keyword;}
    
                Crw_word::createWordDefinition($searchesId, $wordDescription, $wordSynonym);
            } else {
                $searchesId = Crw_search::saveSearch($keyword);
                Crw_word::createWordDefinition($searchesId, "Not Available", "Not Available");
            }

            $message = $response->json();

        } else {
                $msg = array('error' => 'No Results Found Check For Any Error!');
                $message = $msg;
        }

        return response()->json($message); }
    }

    public function nextPage(Request $request)
    {
        if($request->has('yearFrom') && $request->query('yearFrom') != ""){
            $response = Crw_core::coreFilterYearSearch($request->query('query'),$request->query('yearFrom'),$request->query('yearTo'),intval($request->query('currentPage')));
        } else {
            $response = Crw_core::corePaginationSearch($request->query('query'), intval($request->query('currentPage')));
        }
        return $response;
    }

    public function backPage(Request $request)
    {
        if($request->has('yearFrom') && $request->query('yearFrom') != ""){
            $response = Crw_core::coreFilterYearSearch($request->query('query'),$request->query('yearFrom'),$request->query('yearTo'),intval($request->query('currentPage')));
        } else {
            $response = Crw_core::corePaginationSearch($request->query('query'), intval($request->query('currentPage')));
        }
        return $response;
    }

    public function filterYearSearch(Request $request)
    {
        // dd([$request, $request->post('query'),$request->post('yearFrom'),$request->post('yearTo'),$request->post('currentPage')]);
        $response = Crw_core::coreFilterYearSearch($request->post('query'),intval($request->post('yearFrom')),intval($request->post('yearTo')),intval($request->post('currentPage')));
        return $response;
    }

    public function profileLibraryCollections(Request $request)
    {
        $result = Crw_core::with(['coresearch'])->where('user_id', Auth::id())->paginate(10);

        return view('profile.collection')->with(['auth_id'=>Auth::id(), 'auth_name'=>Auth()->user()->name,
                                                'auth_email'=>Auth()->user()->email,'cores'=>$result]);
    }

    public function changeVisibility(Request $request)
    {
        if($request->ajax()){
            $result = Crw_core::where('core_id', $request->id)->update(['visibility' => $request->status]);
            return response()->json($result);
        }
    }

    public function profileView(Request $request)
    {
        $result = User::where('id', Auth::id())->get();
        // dd($result);
        return view('profile.profile')->with('users',$result);
    }
}
