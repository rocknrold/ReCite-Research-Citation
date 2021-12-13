@extends('welcome')
@section('sidebar')
<div style="margin:auto;padding:5%;padding-top:10%;position:fixed;">
          <div class="collection">
        <a href="#about" class="collection-item active">About ReCite</a>
        <a href="#coreservice" class="collection-item">CORE Services API</a>
        <a href="#oxford" class="collection-item">Oxford Dictionary</a>
        <a href="#opencite" class="collection-item">OpenCitation</a>
        <a href="#datacite" class="collection-item">DataCite</a>
        <a href="#function" class="collection-item">Functions</a>
        <a href="#recite" class="collection-item">ReCite API</a>
      </div>
</div>
@endsection
@section('content')
<div style="padding:10%;" id="about">
    <div class="row">
      <div class="col s12"><h4><b>ABOUT</b><div class="divider"></div><br>ReCite ( Research Citation )Web Application</h4></div><div class="divider"></div>
    </div>
        <blockquote style="text-align:justify;">
        ReCite( Research Citation ) offers a free website for research citation with help of 
            CORE services that offer world's largest collection of open access papers and help you get access to it. 
            Combine with Oxford Dictionary for word references. And a useful integration from OpenCitations and DataCite
            enables creation of citations for bibliographic purposes.
        </blockquote>
    <div class="divider"></div>
    <div class="divider"></div>
    <div id="recite">
        <h4><b>ReCite API</b></h4>
        <span><h6>Pulls data from own database</h6></span>
            <div id='getapi'>
            <h5>GET Request : Research Likes and Metadata </h5>
            <p>This query searches for likes or relevance of a research based on our per user reviews.</p>
              <div class="row">
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active" href="#test1">Model</a></li>
        <li class="tab col s3"><a href="#test2">Schema</a></li>
      </ul>
    </div>
    <div id="test1" class="col s12">
<pre>
{
    doi_searched(string) : The doi that has been queried to the database
    details(array[metadata]): details of doi searched {
        title(string) : formal title of the doi
        likes_count(int) : number of likes on this research
        dislikes_count(int) : number of dislikes on this research
        url_identifier(string) : link location of doi in the internet
    } 
}
</pre>
    </div>
    <div id="test2" class="col s12">
<pre>
{
  "doi_searched": "",
  "details": {
    "title_doi": "",
    "likes_count": "",
    "dislikes_count": "",
    "url_identifier": ""
  }
}
</pre>    
    </div>
  </div>
            <p>Query parameters: doi , ex:<span> doi=&lt;doi identifier></span></p>
            <form method="GET">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="queryGetRL" value="/api/GET/research/likes?doi=10.1002/9780470050118.ecse228" style="background-color:black;color:white;"/>
                </div>
                    <button id="runGetRL" type="submit" class="btn btn-secondary">RUN QUERY</button>
            </form>
            <div style="padding-top:20px;">
                <div style="width:100%">
                    <pre id="runGetContent" style="background-color:#e1f5fe;"></pre>
                </div>
            </div>
    </div>
</div>

</div> {{--container end div--}}
@endsection
@section('scripts')
<script src="{{asset('js/docs.js')}}"></script>
@endsection