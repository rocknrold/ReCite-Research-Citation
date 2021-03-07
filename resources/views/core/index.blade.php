@extends('welcome')
@section('sidebar')
<div style="margin:auto;padding:5%;padding-top:10%;position:fixed;">
        <ul>
        <li>Filter By<div id="filters"></div><div id="filterstitle"></div><div id="filtersurl"></div><h6 class="divider"></h6></li>
        <li>Year</li>
        <li>
            <small style="color:red">Custom Range</small>
            <div class="input-field">
                <input id="yearFrom" type="number" class="validate" placeholder="2017" min="1900" max="2021" step="1">
                <label for="yearFrom">From</label>
            </div>
             <div class="input-field">
                <input id="yearTo" type="number" class="validate" placeholder="2021" min="1900" max="2021" step="1">
                <label for="yearTo">To</label>
              <button class="btn waves-effect waves-light black" type="submit" name="action" id="searchFilter">Apply</button>
            </div>
        </li>
        <li><h1 class="divider"></h1></li>
        <li>Required</li>
        <small style="color:red">Should have</small>
        <form action="#">
            <p>
                <input type="checkbox" class="filled-in" id="titleRequired"/>
                <label for="titleRequired">Title</label>
            </p>
            <p>
                <input type="checkbox" class="filled-in" id="documentRequired"/>
                <label for="documentRequired">Document</label>
            </p>
            <button class="btn waves-effect waves-light black" type="submit" name="action" id="requiredFilter">Apply</button>
        </form>
        <li>
        </li>
        </ul>
    </div>
@endsection
@section('content')
<div class="center-search">
    @include('layouts.search')
</div>
<div>
@foreach($query as $k)
<p>Seeing results for <b id="keyword">{{ $k }}</b> : <i id="totalResults"></i> references</p>
@endforeach

<div class="divider"></div>
<div class="row">
    <div class="col s12">
        <!-- Teal page content  -->
<div id="result-list"> 
{{-- @for($i = 0; $i < 10; $i++)
    <div class="section">   
        <div class="row">
            <div class="col s12"><h6><strong>Title : sample</strong></h6></div>
            <div class="col s12"><h6><strong>Author : sample, sample, sample</strong></h6></div>
            <div class="col s6"><p>Year Published : 2021<i> oia </i></p></div>
            <div class="col s12 m6 l3"><button class="bg-white tooltipped" data-position="bottom" data-tooltip="I am a tooltip"><i class="material-icons">add</i></button></div>
            <div class="col s12 m6 l3"><a class="btn bg-transparent"><i class="material-icons">article</i></a></div>       
        </div>
        <blockquote>
        This is an where research description is placed.
        </blockquote>
    </div>
@endfor --}}
</div>
    <div class="divider"></div>
    <div class="col s12">
        <a href="#" class="btn" id="searchLibrary-back"><i class="material-icons">arrow_back_ios</i></a>
        <p id="currentPage" class="btn-flat disabled">1</p>
        <a class="btn" href="#" id="searchLibrary-next"><i class="material-icons">navigate_next</i></a>
    </div>
    </div>
</div>
<br>
@endsection
@section('scripts')
<script src="{{asset('js/routes.js')}}"></script>
@endsection