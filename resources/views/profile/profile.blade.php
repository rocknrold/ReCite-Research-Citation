@extends('welcome')
@section('content')
<div style="margin:auto;padding:5%;padding-top:10%;">
    <div class="row">
    @foreach($users as $user)
    {{-- {{dd($user)}} --}}
            <h5><b>Profile</b></h5>
            <div class="divider"></div><br>
            <div class="row align-wrapper" style="width:200px;">
                <span>
                    <form enctype="multipart/form-data" action="{{route('update.useravatar')}}" method="POST">
                        @csrf
                        <label for="avatar">Change Avatar <i class="tiny material-icons">mode_edit</i></label>
                        <input type="file" name="avatar" id="avatar" style="display:none"/>
                        <button id="avatarUpload" type="submit" class="" style="background-color:#3b5998">save</button>
                    </form>
                    {{-- <img src="../images/no-profile.jpg" alt="" class="circle responsive-img"> --}}
                    <img src="../storage/{{$user->poster}}" alt="" class="circle responsive-img" width="200px">
                </span>
            </div>
            <div class="divider"></div>
            <span><h6>Name</h6></span>
                <div id="newUserName" hidden>
                    <form action="#">
                        <div class="input-field">
                            <input id="username" type="search" required placeholder="New name">
                            <i class="material-icons" id="dismissNameEdit">close</i>
                        </div>
                        <button id="nameSubmit" type="submit" class="btn" style="background-color:#3b5998">update</button>
                    </form>
                </div>
                <div id="editNameDiv"> 
                    <h5><span id="userNameEdit">{{$user->name}}</span>
                        <span><a href="#!" id="btnNameEdit">
                            <i class="tiny material-icons">mode_edit</i></a>
                        </span>
                        <span class="new badge blue" data-badge-caption="online"></span>
                    </h5>
                </div>
            <div class="divider"></div>
            <span><h6>Email</h6></span>
                <div id="newUserEmail" hidden>
                    <form action="#">
                        <div class="input-field">
                            <input id="useremail" type="search" required placeholder="New email" class="validate">
                            <i class="material-icons" id="dismissEmailEdit">close</i>
                        </div>
                        <button id="emailSubmit" type="submit" class="btn" style="background-color:#3b5998">update</button>
                    </form>
                </div>
            <div id="editEmailDiv">
                <h5><span id="userEmailEdit">{{$user->email}}</span>
                    <span><a href="#!" id="btnEmailEdit">
                        <i class="tiny material-icons">mode_edit</i></a>
                    </span>
                </h5>
            </div>
            <div class="divider"></div>
    @endforeach       
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('js/profile.js')}}"></script>
@endsection