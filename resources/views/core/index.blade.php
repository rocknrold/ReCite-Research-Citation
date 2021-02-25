@extends('welcome')
@section('content')

{{-- <nav class="nav-wrapper" style="background-color:#90a4ae; color:black;">
<form>
<div class="input-field">
   
    <input id="search" type="search" required placeholder="search..." value="{{ $k }}">
    <label class="label-icon" for="search" style="position:relative; top:-84px; left:15px;">
    <i class="material-icons">search</i></label>
    <i class="material-icons">close</i>
    @endforeach
</div>
</form>
</nav> --}}
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
    <div class="section">   
        <div class="row">
            <div class="col s12"><h6><strong>Title : sample<strong></h6></div>
            <div class="col s12"><h6><strong>Author : sample, sample, sample<strong></h6></div>
            <div class="col s6"><p>Year Published : 2021<i> oia </i></p></div>
            <div class="col s12 m6 l3"><button class="bg-white bg-transparent"><i class="material-icons">add</i></button><br><small>Add to library</small></div>
            <div class="col s12 m6 l3"><button class="bg-white"><i class="material-icons">picture_as_pdf</i></button><br><small>View PDF</small></div>            
        </div>
        <blockquote>
        This is an where research description is placed.
        </blockquote>
    </div>
</div>
<div class="divider"></div>
<br>
<button style="padding:15px;"><<< 2 >>></button>
@endsection
@section('scripts')
<script src="{{asset('js/routes.js')}}"></script>
@endsection