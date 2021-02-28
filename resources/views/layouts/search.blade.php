<nav style="background-color:black">
    <form class="nav-wrapper" action="{{ route('core.search') }}" method="GET" id="search-library">
    {{-- @csrf --}}
    <div class="input-field">
        <input id="search" type="search" required name="query" placeholder="search...">
        <label class="label-icon" for="search" style="position:relative; top:-84px; left:15px;">
        <i class="material-icons">search</i></label>
        <i class="material-icons">close</i>
    </div>
    </form>
</nav> 