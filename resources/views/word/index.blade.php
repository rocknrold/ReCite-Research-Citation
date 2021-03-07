@extends('welcome')
@section('content')
<div style="padding-top:7%;">
<h3>What does it mean?</h3>
<h6>Popular searches</h6>
@if(isset($words['error']))
    <div class="row">
        {{-- <div class="col s12 m4 l8"><h3>{{$words['error']}}</h3></div> --}}
              <div class="col s4">
        <!-- Promo Content 1 goes here -->
      </div>
      <div class="col s4">
        <!-- Promo Content 2 goes here -->
        <i class="large material-icons">error_outline</i>
        <h4>{{$words['error']}}</h4>
      </div>
      <div class="col s4">
        <!-- Promo Content 3 goes here -->
      </div>
    </div>
    
@else

<div class="divider"></div>
<h5 style="padding-bottom:1%;"></h5>
  <ul class="collapsible popout container-fluid" data-collapsible="accordion">
  @foreach($words as $key => $word)
    <li>
        <div class="collapsible-header"><i class="material-icons">text_format</i>{{ $key }}</div>
        <div class="collapsible-body"><h5>{{ $key }}</h5><p>Definition</p><p>{{ $word['definitions'][0] }}</p></div>
    </li>
  @endforeach
  </ul>
<h5 style="padding-bottom:1%;"></h5>
<div class="divider"></div>
<h6>Suggested Terms<small style="padding-left:5px;color:red;">See also ...<small></h6>
    @foreach($words as $word)
        @if(array_key_exists('synonyms',$word))
            @foreach($word['synonyms'] as $synonym)
                <li><h6><a href="#" id="{{ $synonym['text'] }}">{{ $synonym['text'] }}</a></h6></li>
            @endforeach
        @endif
    @endforeach
</div>
@endif
@endsection
{{-- @section('scripts')
<script src="{{asset('js/wordroute.js')}}"></script>
@endsection --}}