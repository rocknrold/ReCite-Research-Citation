@extends('welcome')
@section('content')
<div style="padding-top:10%;display:block;">
    @foreach($items as $key => $value)
<div class="row">
 <div class="col s12">
        <ul class="collection with-header">
            <li class="collection-header"><h4>{{$key}}</h4></li>
            @foreach($value as $key => $core)
                @if($core->core_description === "null")
                    <li class="collection-item">
                    <div><a style="font-weight:bold;" onmouseover="this.style.color='red'" onmouseleave="this.style.color='#000'" href="{{$core->core_downloadUrl}}">{{$core->core_title}}</a>
                    <a href="#!" class="secondary-content articleLike"  data-id="like_{{$core->core_id}}"><i class="material-icons">thumb_up</i><span class="badge">{{$core->likes}}</span></a>
                    <a href="#!" class="secondary-content articleLike"  data-id="dislike_{{$core->core_id}}"><i class="material-icons">thumb_down</i><span class="badge">{{$core->dislikes}}</span></a>
                    <div class="col s6 offset-s6"><span class="flow-text">6-columns (offset-by-6)</span></div>
                    <p><i>{{$core->core_yearPublished}} </i></p>
                    <p><small style="color:red">Preview</small><blockquote>No Preview Available</blockquote></p>
                    </div>
                    </li>
                    @foreach($core->corecitation as $key => $value)
                        <h1>{{$value->crw_citation_count}}</h1>
                    @endforeach
                @else
                    <li class="collection-item">
                    <div><a style="font-weight:bold;" onmouseover="this.style.color='red'" onmouseleave="this.style.color='#000'" href="{{$core->core_downloadUrl}}">{{$core->core_title}}</a><span class="new badge blue" data-badge-caption="Citations">{{$core->corecitation->crw_citation_count}}</span></div>
                    <div class="col s6 offset-s6" style="padding-top:2%;"><a href="#!" class="secondary-content articleLike"  data-id="like_{{$core->core_id}}"><i class="material-icons">thumb_up</i><span class="badge">{{$core->likes}}</span></a>
                    <a href="#!" class="secondary-content articleLike"  data-id="dislike_{{$core->core_id}}"><i class="material-icons">thumb_down</i><span class="badge">{{$core->dislikes}}</span></a></div>
                    <p><i>{{$core->core_yearPublished}} </i></p>
                    <p><small style="color:red">Preview</small><blockquote>{{$core->core_description}}</blockquote></p>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div> 
    @endforeach
</div>
@endsection
@section('scripts')
<script src="{{asset('js/groups.js')}}"></script>
@endsection