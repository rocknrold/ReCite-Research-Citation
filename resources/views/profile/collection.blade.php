@extends('welcome')
@section('sidebar')
<div style="margin:auto;padding:5%;padding-top:10%;position:fixed;">
    <div class="row">
            <h5><b>Profile</b></h5>
            <div class="divider"></div><br>
            <div class="row valign-wrapper" style="width:200px;">
              <img src="../../../storage/{{Auth::User()->poster}}" alt="" class="circle responsive-img" width="150px">
            </div>
            <div class="divider"></div>
            <span><h6>Name</h6></span><h5>{{$auth_name}}<span class="new badge blue" data-badge-caption="online"></span></h5>
            <div class="divider"></div>
            <span><h6>Email</h6></span><h5>{{$auth_email}}</h5>
            <div class="divider"></div>
            
    </div>
</div>
@endsection
@section('content')
<div style="padding:10%;" id="about">
    <h5>Collection</h5>
    <div class="divider"></div>
    <span><h6>Library item you dont share is checked as private</h6></span>
        <div style="display:inline-block"> 
            <p>
            <input type="checkbox" class="filled-in" checked disabled/>
            <label for="filled-in-box">Private</label>
            </p>
        </div>
        <div style="display:inline-block"> 
            <p>
            <input type="checkbox" class="filled-in" disabled/>
            <label for="filled-in-box">Public</label>
            </p>
        </div>
      <table class="striped" >
        <thead>
          <tr>
              <th>Visibility</th>
              <th>Title</th>
              <th>Year</th>
              <th>Term</th>
          </tr>
        </thead>

        <tbody id="user-collection-table">
    @foreach ($cores as $core)
          <tr>
            <td>
            @if($core->visibility == "private")
                <p>
                <input type="checkbox" class="filled-in" checked="checked" id="{{$core->core_id}}"/>
                <label for="filled-in-box" class="item-visibility" data-id="{{$core->core_id}}"></label>
                </p>
            @else
                <p>
                <input type="checkbox" class="filled-in" id="{{$core->core_id}}"/>
                <label for="filled-in-box" class="item-visibility" data-id="{{$core->core_id}}"></label>
                </p>
            @endif
            </td>
            <td>{{$core->core_title}}</td>
            <td>{{$core->core_yearPublished}}</td>
            <td>web</td>
          </tr>
    @endforeach
        </tbody>
      </table>
    <div class="col s12">
        <a href="{{$cores->previousPageUrl()}}" class="btn" style="background-color:#3b5998" id="searchLibrary-back"><i class="material-icons">arrow_back_ios</i></a>
        <p id="currentPage" class="btn-flat disabled">{{$cores->currentPage()}}</p>
        <a class="btn" href="{{$cores->nextPageUrl()}}" style="background-color:#3b5998" id="searchLibrary-next"><i class="material-icons">arrow_forward_ios</i></a>
    </div>
</div>
</div>

@endsection
@section('scripts')
<script src="{{asset('js/collection.js')}}" ></script>
@endsection