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
}
