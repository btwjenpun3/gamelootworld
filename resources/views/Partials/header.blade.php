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
            <div class="col-lg-8">
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
            <div class="col-lg-2">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    <a href="./login.html"><span class="icon_profile"></span></a>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
