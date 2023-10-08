@extends('Layouts.Home.home')

@section('slider')
    @include('Partials.slider')
@endsection

@section('content')
    <section class="product spad">
        <div class="container">
            {{-- Steam Games --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Steam Free Giveaways</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{ route('loots.steam') }}" class="primary-btn">View All <span
                                            class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($steams as $steam)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ $steam->slug }}">
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ asset('/storage/post/images/' . $steam->image) }}">
                                                @php
                                                    $call = new App\Http\Controllers\HomeController();
                                                    $price = $call->priceDisplay($steam->worth, $steam->status);
                                                @endphp
                                                {{ $price }}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = $steam->platforms()->get();
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}">
                                                        <li>{{ $platform->name }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{ $steam->slug }}">{{ $steam->title }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- Steam Games --}}

            {{-- Epic Games --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Epic Free Giveaways</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{ route('loots.epic') }}" class="primary-btn">View All <span
                                            class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($epics as $epic)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ $epic->slug }}">
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ asset('/storage/post/images/' . $epic->image) }}">
                                                @php
                                                    $call = new App\Http\Controllers\HomeController();
                                                    $price = $call->priceDisplay($epic->worth, $epic->status);
                                                @endphp
                                                {{ $price }}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = $epic->platforms()->get();
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}">
                                                        <li>{{ $platform->name }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{ $epic->slug }}">{{ $epic->title }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- Epic Games --}}

            {{-- GOG Games --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>GOG Free Giveaways</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{ route('loots.gog') }}" class="primary-btn">View All <span
                                            class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($gogs as $gog)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ $gog->slug }}">
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ asset('/storage/post/images/' . $gog->image) }}">
                                                @php
                                                    $call = new App\Http\Controllers\HomeController();
                                                    $price = $call->priceDisplay($gog->worth, $gog->status);
                                                @endphp
                                                {{ $price }}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = $gog->platforms()->get();
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}">
                                                        <li>{{ $platform->name }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{ $gog->slug }}">{{ $gog->title }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- GOG Games --}}

            {{-- Itch Games --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Itch.io Free Giveaways</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{ route('loots.itch') }}" class="primary-btn">View All <span
                                            class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($itchs as $itch)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ $itch->slug }}">
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ asset('/storage/post/images/' . $itch->image) }}">
                                                @php
                                                    $call = new App\Http\Controllers\HomeController();
                                                    $price = $call->priceDisplay($itch->worth, $itch->status);
                                                @endphp
                                                {{ $price }}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = $itch->platforms()->get();
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}">
                                                        <li>{{ $platform->name }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{ $itch->slug }}">{{ $itch->title }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- Itch Games --}}

            {{-- DLCs --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>DLCs Free Giveaways</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="{{ route('loots.dlcs') }}" class="primary-btn">View All <span
                                            class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($dlcs as $dlc)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ $dlc->slug }}">
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ asset('/storage/post/images/' . $dlc->image) }}">
                                                @php
                                                    $call = new App\Http\Controllers\HomeController();
                                                    $price = $call->priceDisplay($dlc->worth, $dlc->status);
                                                @endphp
                                                {{ $price }}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = $dlc->platforms()->get();
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}">
                                                        <li>{{ $platform->name }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{ $dlc->slug }}">{{ $dlc->title }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- DLCs --}}
        </div>
    </section>
@endsection
