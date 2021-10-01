<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crw_core;
use App\Http\Resources\DoiLikesResource;
use App\Http\Resources\DoiRequestUnprocessable;

class ApiController extends Controller
{
    public function getRl(Request $request)
    {
        if($request->has('doi') && $request->get('doi') !== null){
            $doiName = $request->get('doi');
            $result = Crw_core::with(['coresearch'])->where('core_doi', $request->doi)->first();
            
            $result ? 
            $response = new DoiLikesResource($result) :  
            $response = response()->json(['error'=>"No results found in the database"]);

            return $response;
        }

        return new DoiRequestUnprocessable($request);    
    }
}
