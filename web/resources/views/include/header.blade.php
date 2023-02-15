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

    $num = floor((100-\App\Server\Connector::method()->getStatus()['cpuUsage'])/25)+1;

    @endphp


    <div class="d-flex align-items-center justify-content-between">
        <a class="header-item d-flex align-items-center {{$icon}} ri-2x" href="{{$href}}">
        </a>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <a class="header-item d-flex align-items-center bi-stack ri-2x" href="/panel">
        </a>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <i class="header-item d-flex align-items-center  bi-reception-{{$num}} ri-2x">
        </i>
    </div>
    @include('include.searchbar')

</header>
