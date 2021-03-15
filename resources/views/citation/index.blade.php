@extends('welcome')
@section('content')
  <div class="row" style="margin:auto;padding-top:10%;">
    {{-- <button id="scrape">scrape web</button> --}}
    <div class="col s12">
        <h3>Open Citation Reference</h3>
    </div>
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">search</i>
          <input type="text" id="autocomplete-input">
          <label for="autocomplete-input">Search for an entity by title </label>
        </div>
      </div>
    </div>
    <div class="col s12 citations"></div>
  </div>
{{-- @for($i = 0; $i < 10; $i++)  
<div class="row" style="padding:0px;margin:auto;">
    <div class="col s12" ></div>
      <div class="card-panel light-blue lighten-5" style="border-radius:6px;box-shadow:none;border:1px solid #bbdefb">
        <a class="secondary-content copy" style="padding:1px;"  data-id="citation_{{$i}}"><i class="material-icons">content_copy</i></a>
        <span class="black-text cite" id="citation_{{$i}}">
        Im the citation {{ $i }} ---> Peroni,S.,Dutton,A.,Gray,T., & Shotton,D.(2015).Setting Our Bibliographic References Free: Towards Open Citation Data.<i>Journal Of Documentation</i>,253-277.https://doi.org/10.1108/jd-12-2013-0166
        </span>
    </div>
</div>
@endfor --}}
@endsection
@section('scripts')
<script src="{{asset('js/citation.js')}}"></script>
@endsection