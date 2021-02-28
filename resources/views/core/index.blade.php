@extends('welcome')
@section('content')

<div class="center-search">
    @include('layouts.search')
</div>
<div>
@foreach($query as $k)
<p>Seeing results for <b id="keyword">{{ $k }}</b> : <i id="totalResults"></i> references</p>
@endforeach
</div>
<div id="result-list"> 
<div class="divider"></div>
{{-- @for($i = 0; $i < 10; $i++)
    <div class="section">   
        <div class="row">
            <div class="col s12"><h6><strong>Title : sample</strong></h6></div>
            <div class="col s12"><h6><strong>Author : sample, sample, sample</strong></h6></div>
            <div class="col s6"><p>Year Published : 2021<i> oia </i></p></div>
            <div class="col s12 m6 l3"><button class="btn"><i class="material-icons">add</i></button><br><small>Add to library</small></div>
            <div class="col s12 m6 l3"><a><i class="material-icons">picture_as_pdf</i></a><br><small>View PDF</small></div>       
        </div>
        <blockquote>
        This is an where research description is placed.
        </blockquote>
    </div>
@endfor --}}
</div>
<div class="divider"></div>
<br>

<div class="row">
    <div class="col s12">
        <a href="#" class="btn" id="searchLibrary-back"><i class="material-icons">arrow_back_ios</i></a>
        <p id="currentPage" class="btn-flat disabled">1</p>
        <a class="btn" href="#" id="searchLibrary-next"><i class="material-icons">navigate_next</i></a>
    </div>
</div>


@endsection
@section('scripts')
<script src="{{asset('js/routes.js')}}"></script>
@endsection