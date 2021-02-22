@extends('welcome')
@section('content')
<!-- SEARCH BAR AREA -->
<div class="center-search">
    <h2>Core Research Word</h2>
    <blockquote>Find by words and add to your document list..</blockquote>
    @include('layouts.search')
    <ul class="nav">
        <li style="font-weight:bold;color:black;padding-left:0px;">Popular:</li>
        @foreach($popular as $word)
        <li>{{ $word }}</li>|
        @endforeach
    </ul>
</div>
<!-- END SEARCH BAR AREA -->

<!-- Element Showed -->
<div class="fixed-action-btn" style="bottom: 45px; right: 50px;">
    <a id="menu" class="btn btn-floating btn-large cyan"><i class="material-icons">vpn_key</i></a>
</div>

<!-- Start Tap Target Structure -->
<div class="tap-target blue" data-activates="menu">
    <div class="tap-target-content white-text text-center">
        <h5>CRW team</h5>
        <p>Core Research Word offers a free website for research citation purposes with the help of 
            CORE services that offers world's largest collection of open access papers and help you get access to it. 
            Combine with Oxford Dictionary for word references.</p>
    </div>
</div>
<!-- End Tap Target Structure -->
@endsection