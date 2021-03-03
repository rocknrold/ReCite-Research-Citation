<nav style="background-color:white;position:fixed;top:0;overflow:auto;z-index: +1;">
    <div class="nav-wrapper">      
        <ul class="left align-text-top">
            <li><a class="waves-effect waves-teal btn-flat" href="/">
                <img src="{{ asset('images/crw-logo.png')}}" class="box responsive-img" width=4%; height=auto;>
                Core Research Word</a>
            </li>
        </ul>
        <ul class="right hide-on-med-and-down">
            <li><a class="waves-effect waves-teal btn black" href="{{ route('core.index') }}">Library<i class="material-icons right">local_library</i></a></li>
            <li><a class="waves-effect waves-teal btn black" href="{{ route('words.list') }}">Words<i class="material-icons right">text_format</i></a></li>
            <li><a class="waves-effect waves-teal btn black" href="{{ route('crw.index') }}">Groups<i class="material-icons right">list</i></a></li>
            <li><a class="waves-effect waves-teal btn black">List<i class="material-icons right">dynamic_form</i></a></li>
            <li><a class="waves-effect waves-teal btn black">Docs<i class="material-icons right">article</i></a></li>
        </ul>
    </div>
</nav>