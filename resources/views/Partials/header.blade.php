<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('home.index') }}">
                        <img src="/img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="{{ route('home.index') }}">Home</a></li>
                            <li><a href="#">Categories <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('loots.games') }}">All Games</a></li>
                                    <li><a href="{{ route('loots.dlcs') }}">All DLCs</a></li>
                                    <li><a href="{{ route('loots.steam') }}">Steam</a></li>
                                    <li><a href="{{ route('loots.epic') }}">Epic Store</a></li>
                                    <li><a href="{{ route('loots.gog') }}">GOG Store</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    @if (Auth::check())
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('collection.index') }}"
                                style="color:black;font-size:15px;"><i class="fa fa-briefcase"></i>
                                My Collections</a>
                            <a class="dropdown-item" href="#" style="color:black;font-size:15px;"><i
                                    class="fa fa-cog"></i> Settings</a>
                            <hr>
                            <a class="dropdown-item" href="{{ route('login.logout') }}"
                                style="color:red;font-size:15px;"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    @else
                        <a href="{{ route('login.index') }}"><span class="icon_profile"></span></a>
                    @endif
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
