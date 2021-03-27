@extends('welcome')
@section('content')
<!-- SEARCH BAR AREA -->
<div class="center-search">
    <div>
    <li style="display:inline-block"><h2>ReCite</h2></li>
    <li style="display:inline-block"><h6><i>Research Citation</i></h6></li>
    </div>
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
<div class="tap-target light-blue darken-3" data-activates="menu">
    <div class="tap-target-content white-text text-center">
        <h5>ReCite Team</h5>
        <p style="padding-left:10%;">ReCite( Research Citation ) offers a free website for research citation with help of 
            CORE services that offer world's largest collection of open access papers and help you get access to it. 
            Combine with Oxford Dictionary for word references. And a useful integration from OpenCitations and DataCite
            enables creation of citations for bibliographic purposes.</p>
    </div> 
</div>
<!-- End Tap Target Structure -->
@endsection