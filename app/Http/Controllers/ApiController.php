<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crw_core;

class ApiController extends Controller
{
    public function getRl(Request $request)
    {
        if($request->has('doi') && $request->get('doi') !=""){
            $doiName = $request->get('doi');
            $result = Crw_core::with(['coresearch'])->where('core_doi', $request->doi)->first();
            
            if($result){

                
                $title_doi = $result->core_title;
                $likes_count = $result->likes;
                $dislikes_count = $result->dislikes;
                $url_identifier = $result->core_downloadUrl;
                
                
                return response()->json(["doi_searched"=>$doiName,
                "details"=> [
                    "title_doi"=>$title_doi,
                    "likes_count"=>$likes_count,
                    "dislikes_count"=>$dislikes_count,
                    "url_identifier"=>$url_identifier]]);
            }else {
                return response()->json(['error'=>"No results found in the database"]);
            }
        }
        return response()->json(["error"=>"wrong request format please see documentation",
                                "fixes"=>["specify do ?doi=<doi identifier>","check documentation"]]);      
    }
}
