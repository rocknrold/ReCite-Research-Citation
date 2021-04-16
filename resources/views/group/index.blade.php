@extends('welcome')
@section('sidebar')
@endsection
@section('content')
@if(isset($items['error']))
    <div class="row"style="margin: auto;width: 100%;padding:10%;">
    <div class="col s12">
        <i class="large material-icons">error_outline</i>
        <span class="flow-text"><h5>{{$items['error']}}</h5></span>
    </div>
    </div>
@else
    
<div style="padding-top:10%;display:block;" id="jumpTo">
    @foreach($items as $key => $value)
    @if(count($value->usercore) >= 1 && $value->usercore[0]->visibility != "private")
        <div class="row">
        <div class="col s12">
                <ul class="collection with-header">
                    <li class="collection-item avatar">
                            <img src="../storage/{{$value->poster}}" alt="" class="circle">
                            <span class="title">{{$value->name}}</span>
                            <p><i class="material-icons">gpp_good</i></p>
                            <p class="secondary-content"><i class="material-icons">public</i></p>
                    </li>
                    <ul class="collapsible" data-collapsible="accordion">

                    @foreach($value->usercore as $core)
                        @if($core->core_description === "null" && $core->visibility === "public")
                            <li>
                            <div class="collapsible-header">
                                    <a style="font-weight:bold;" onmouseover="this.style.color='red'" onmouseleave="this.style.color='#000'" href="{{$core->core_downloadUrl}}">{{$core->core_title}}</a>
                                    <span><small style="margin-left:1.25em;color:grey">see more...</small></span>
                                    <span class="new badge blue" data-badge-caption="total citation">{{$core->crw_citation_count}}</span>
                            </div>
                            <div class="collapsible-body">
                                {{-- <a style="font-weight:bold;" onmouseover="this.style.color='red'" onmouseleave="this.style.color='#000'" href="{{$core->core_downloadUrl}}">{{$core->core_title}}</a> --}}
                                <div class="col s6 offset-s6">
                                    <a href="#!" class="secondary-content articleLike"  data-id="like_{{$core->core_id}}">
                                        <i class="material-icons">thumb_up</i><span class="badge">{{$core->likes}}</span>
                                    </a>
                                    <a href="#!" class="secondary-content articleLike"  data-id="dislike_{{$core->core_id}}">
                                        <i class="material-icons">thumb_down</i><span class="badge">{{$core->dislikes}}</span>
                                    </a>
                                </div>
                                <p><i>{{$core->core_yearPublished}} </i></p>
                                <p><small style="color:red">Preview</small><blockquote>No Preview Available</blockquote></p>
                            </div>
                            </li>
                        @endif
                        @if($core->core_description !== "null" && $core->visibility === "public")
                            <li>
                            <div class="collapsible-header">
                                    <a style="font-weight:bold;" onmouseover="this.style.color='red'" onmouseleave="this.style.color='#000'" href="{{$core->core_downloadUrl}}">{{$core->core_title}}</a>
                                    <span><small style="margin-left:1.25em;color:grey">see more...</small></span>
                                    <span class="new badge blue" data-badge-caption="total citation">{{$core->crw_citation_count}}</span>
                            </div>
                            <div class="collapsible-body">
                                <div class="col s6 offset-s6" style="padding-top:2%;">
                                    <a href="#!" class="secondary-content articleLike"  data-id="like_{{$core->core_id}}">
                                        <i class="material-icons">thumb_up</i><span class="badge">{{$core->likes}}</span>
                                    </a>
                                    <a href="#!" class="secondary-content articleLike"  data-id="dislike_{{$core->core_id}}">
                                        <i class="material-icons">thumb_down</i><span class="badge">{{$core->dislikes}}</span>
                                    </a>
                                </div>
                                <p><i>{{$core->core_yearPublished}} </i></p>
                                <p><small style="color:red">Preview</small><blockquote>{{$core->core_description}}</blockquote></p>
                            </div>
                            </li>
                        @endif
                    @endforeach
                    </ul> 
                </ul>
            </div>
        </div>
    @endif
    @endforeach
</div>
@endif
<div class="col s12">
    <a href="{{$items->previousPageUrl()}}" class="btn" style="background-color:#3b5998" id="searchLibrary-back"><i class="material-icons">arrow_back_ios</i></a>
    <p id="currentPage" class="btn-flat disabled">{{$items->currentPage()}}</p>
    <a class="btn" href="{{$items->nextPageUrl()}}" style="background-color:#3b5998" id="searchLibrary-next"><i class="material-icons">arrow_forward_ios</i></a>
</div>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large" href="#jumpTo" style="background-color:#3b5998">
      <i class="large material-icons">arrow_drop_up</i>
    </a>
</div>
@endsection
@section('scripts')
<script src="{{asset('js/groups.js')}}"></script>
@endsection