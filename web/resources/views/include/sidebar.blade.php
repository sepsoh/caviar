<ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link
            @if(\Illuminate\Support\Facades\Request::path()!='/')
                collapsed
            @endif" href="/">
            <i class="bi bi-house"></i>
            <span>Home</span>
        </a>
    </li><!-- End Home Page Nav -->

        <li class="nav-item">
            <a class="nav-link
            @if(\Illuminate\Support\Facades\Request::path()!='register')
                collapsed
            @endif" href="/register">
                <i class="bi bi-person"></i>
                <span>Register</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link
            @if(\Illuminate\Support\Facades\Request::path()!='login')
                collapsed
            @endif" href="/login">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->

       {{-- <li class="nav-item">
            <a class="nav-link
            @if(\Illuminate\Support\Facades\Request::path()!='contact')
                collapsed
            @endif" href="/content">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->--}}
    </ul>

