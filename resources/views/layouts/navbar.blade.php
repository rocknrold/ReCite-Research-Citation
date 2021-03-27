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
            @if(Auth::check())
            <form method="POST" action="{{ route('logout') }}" class="right hide-on-med-and-down">
                    @csrf
                    <li><button style="background-color:#3B5998">Logout<i class="material-icons right">lock_open</i></button></li>
            </form>
            @else
            <li><a href="{{ route('login') }}">Login<i class="material-icons right">lock</i></a></li>
            @endif
        </ul>
    </div>
</nav>