<?php

namespace App\Http\Controllers;

use App\Models\Crw_core_citation;
use Illuminate\Http\Request;

class CrwCoreCitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function citationIndex()
    {
        return view('citation.index');
    }

    public function citationList(Request $request)
    {
        if($request->ajax())
        {
            $response = Crw_core_citation::getCoreCitations();
        }
        return response()->json($response);
    }
}
