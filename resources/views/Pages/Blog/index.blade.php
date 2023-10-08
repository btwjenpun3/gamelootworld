@extends('Layouts.Home.home')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <span>{{ $title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <section class="product spad">
        <div class="p-5 text-center bg-image rounded-3"
            style="background-image:url(/storage/contents/Header_1.jpg);filter:grayscale(10%)">
            <div class="mask">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 class="mb-3">
                            @if ($title == 'Steam Free Giveaways')
                                <i class="fa fa-steam-square"></i> Steam
                            @elseif($title == 'Epic Free Giveaways')
                                <i class="fa fa-epic-games"></i> Epic Store
                            @elseif($title == 'GOG Free Giveaways')
                                <i class="fa fa-epic-games"></i> GOG
                            @elseif($title == 'Itch.io Free Giveaways')
                                <i class="fa fa-epic-games"></i> Itch.io
                            @elseif($title == 'Games Free Giveaways')
                                <i class="fa fa-epic-games"></i> {{ $title }}
                            @elseif($title == 'DLCs Free Giveaways')
                                <i class="fa fa-epic-games"></i> {{ $title }}
                            @endif
                        </h1>
                        <h5 class="mb-3">
                            @if ($title == 'Steam Free Giveaways')
                                Steam is a video game digital distribution service and storefront developed
                                by
                                Valve Corporation. It was launched as a software client in September 2003 to provide game
                                updates automatically for Valve's games, and expanded to distributing third-party titles in
                                late
                                2005.
                            @elseif($title == 'Epic Free Giveaways')
                                The Epic Games Store is a video game digital distribution service and storefront operated by
                                Epic Games. It launched in December 2018 as a software client, for Microsoft Windows and
                                macOS, and online storefront.
                            @elseif($title == 'GOG Free Giveaways')
                                GOG.com (formerly Good Old Games) is a digital distribution platform for video games and
                                films. It is operated by GOG sp. z o.o., a wholly owned subsidiary of CD Projekt based in
                                Warsaw, Poland.
                            @elseif($title == 'Itch.io Free Giveaways')
                                Itch.io (stylized in all lowercase) is a website for users to host, sell and download indie
                                video games, indie role-playing games, game assets, comics, zines and music. Launched in
                                March 2013 by Leaf Corcoran, the service hosts over 700,000 products as of April 2023.
                            @endif
                        </h5>
                        @if ($title == 'Steam Free Giveaways')
                            <a class="btn btn-outline-light btn-lg" href="https://store.steampowered.com/" role="button"
                                target="_blank">Go to Store</a>
                        @elseif($title == 'Epic Free Giveaways')
                            <a class="btn btn-outline-light btn-lg" href="https://store.epicgames.com/en-US/" role="button"
                                target="_blank">Go to Store</a>
                        @elseif($title == 'GOG Free Giveaways')
                            <a class="btn btn-outline-light btn-lg" href="https://www.gog.com/" role="button"
                                target="_blank">Go to Store</a>
                        @elseif($title == 'Itch.io Free Giveaways')
                            <a class="btn btn-outline-light btn-lg" href="https://itch.io/" role="button"
                                target="_blank">Go to Store</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>{{ $title }} <span>({{ $count }})</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($datas as $data)
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
                                    <div class="product__item">
                                        <a href="/{{ $data->slug }}">
                                            <div class="product__item__pic set-bg @if ($data->status == 'Expired') expired @endif"
                                                data-setbg="{{ asset('/storage/post/images/' . $data->image) }}">
                                                @if ($data->status == 'Expired')
                                                    <div class="expired-overlay">Expired</div>
                                                @endif
                                                @php
                                                    $call = new App\Http\Controllers\HomeController();
                                                    $price = $call->priceDisplay($data->worth, $data->status);
                                                @endphp
                                                {{ $price }}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = $data->platforms()->get();
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}">
                                                        <li>{{ $platform->name }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <h5><a href="/{{ $data->slug }}">
                                                    @if ($data->status == 'Expired')
                                                        <strong style="color:red;">(Expired)</strong>
                                                    @endif
                                                    {{ $data->title }}
                                                </a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $datas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
