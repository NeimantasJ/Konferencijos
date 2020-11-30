<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">

                </ul>
                @auth
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="../assets/images/faces-clipart/pic-3.png" alt="image" />
                                </div>
                                <div class="nav-profile-text">
                                    <p class="text-black font-weight-semibold m-0"> {{ \Illuminate\Support\Facades\Auth::user()->name }} </p>
                                    <span class="font-13 online-color">Veiksmai <i class="mdi mdi-chevron-down"></i></span>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ url('/logout') }}">
                                    <i class="mdi mdi-logout mr-2 text-primary"></i> Atsijungti </a>
                            </div>
                        </li>
                    </ul>
                @endauth
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="mdi mdi-compass-outline menu-icon"></i>
                            <span class="menu-title">Prisijungimas</span>
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/conference') }}">
                            <i class="mdi mdi-compass-outline menu-icon"></i>
                            <span class="menu-title">Konferencijos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/registerParticipant') }}">
                            <i class="mdi mdi-clipboard-text menu-icon"></i>
                            <span class="menu-title">Registruotis kaip dalyvis</span>
                        </a>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::user()->type > 3)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/audience') }}">
                                <i class="mdi mdi-clipboard-text menu-icon"></i>
                                <span class="menu-title">Auditorijos</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/users') }}">
                                <i class="mdi mdi-clipboard-text menu-icon"></i>
                                <span class="menu-title">Vartotojai</span>
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </nav>
</div>
