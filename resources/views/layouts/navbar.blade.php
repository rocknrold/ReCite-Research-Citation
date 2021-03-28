<nav style="background-color:#3B5998;position:fixed;top:0;overflow:auto;z-index: +1;width:100%;height:auto;">
    <div class="nav-wrapper">
            <a class="brand-logo" href="/" style="padding-left:5px;">
                <img src="{{ asset('images/crw-logo.png')}}" class="box responsive-img" width=8%; height=auto;>ReCite
            </a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{ route('core.index') }}">Library<i class="material-icons right">local_library</i></a></li>
            <li><a href="{{ route('words.list') }}">Words<i class="material-icons right">text_format</i></a></li>
            <li><a href="{{ route('core.citation') }}">Citation<i class="material-icons right">dynamic_form</i></a></li>
            <li><a href="{{ route('crw.index') }}">Groups<i class="material-icons right">list</i></a></li>
            <li><a href="/documentation">Docs<i class="material-icons right">integration_instructions</i></a></li>
            @if(!Auth::check())
            <li><a href="{{ route('login') }}">Login<i class="material-icons right">lock</i></a></li>
            @endif
        </ul>
    </div>
</nav>
@if(Auth::check())
<div class="fixed-action-btn horizontal user-menu">
    <a class="btn-floating btn-large" style="background-color:#3b5998">
    <i class="material-icons">person</i>
    </a>
    <ul>
    <li><a class="btn-floating indigo lighten-2" href="{{route('viaGet.logout')}}"><i class="material-icons">lock_open</i></a></li>
    {{-- <li><a class="btn-floating indigo lighten-2"><i class="material-icons">insert_chart</i></a></li> --}}
    <li><a class="btn-floating indigo lighten-2" href="/profile/library/collections/"><i class="material-icons">book</i></a></li>
    <li><a class="btn-floating indigo lighten-2"><i class="material-icons">account_circle</i></a></li>
    </ul>
</div>
@endif