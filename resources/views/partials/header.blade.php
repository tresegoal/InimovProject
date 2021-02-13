<header class="header-v3">

    <div class="container-menu-desktop trans-03" >
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop p-l-45" style="background-color: #0b0b0b;">

                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('images/icons/logo-02.png') }}" alt="IMG-LOGO">
                </a>

                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('product') }}">Boutique</a>
                        </li>
                        <li class="label1" data-label1="hot">
                            <a href="{{ route('product.new') }}">Nouveautés</a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                    @if (Route::has('login'))
                        <div class="navbar navbar-static-top" style="margin-left: 655px; color: #fff;">
                            <ul class="main-menu">
                                @auth
                                    @role('super-admin')
                                    <a href="{{ url('/admin/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                                    @endrole
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form1').submit();">
                                            <span class="title">@lang('quickadmin.qa_logout')</span>
                                        </a>
                                        <form id="logout-form1" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                                    @endif
                                 @endauth
                            </ul>
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </div>

    <div class="wrap-header-mobile" style="background-color: #0b0b0b;">

        <div class="logo-mobile">
            <a href="{{ url('/') }}"><img src="{{ asset('images/icons/logo-02.png') }}" alt="IMG-LOGO"></a>
        </div>

        <div class="btn-show-menu-mobile hamburger hamburger--squeeze" style="background-color: white;">
            <span class="hamburger-box" style="background-color: white;">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>

        <div class="menu-mobile">
            <ul class="main-menu-m">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                    <span class="arrow-main-menu-m">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </span>
                </li>
                <li>
                    <a href="{{ route('product') }}">Boutique</a>
                </li>
                <li>
                    <a href="{{ route('product.new') }}" class="label1 rs1" data-label1="hot">Nouveautés</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <button class="flex-c-m btn-hide-modal-search trans-04">
            <i class="zmdi zmdi-close"></i>
        </button>
        <form class="container-search-header">
            <div class="wrap-search-header">
                <input class="plh0" type="text" name="search" placeholder="Search...">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
        </form>
    </div>
</header>