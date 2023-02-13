<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            @include('include.logo')
        </a>
    </div>
    @php
    if(\Illuminate\Support\Facades\Auth::check()){
        $href='/logout';
        $icon = 'bi-person-x';
    }else{
        $href="/login";
        $icon = 'bi-person-lines-fill';
        }
    @endphp


    <div class="d-flex align-items-center justify-content-between">
        <a class="header-item d-flex align-items-center {{$icon}} ri-2x" href="{{$href}}">
        </a>
    </div>
    @include('include.searchbar')

</header>
