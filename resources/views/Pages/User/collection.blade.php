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
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4><i class="fa fa-gift"></i> My Collections</h4>
                                </div>
                            </div>
                        </div>
                        @if (session()->has('title'))
                            <div class="alert alert-warning">
                                <strong>{{ session('title') }}</strong> was removed from your collections.
                            </div>
                        @endif
                        <div class="row">
                            @foreach ($collections as $collection)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ route('loot.index', ['slug' => $collection->slug]) }}">
                                            <div class="product__item__pic set-bg @if ($collection->status == 'Expired') expired @endif"
                                                data-setbg="{{ asset('/storage/post/images/' . $collection->image) }}">
                                                @if ($collection->status == 'Expired')
                                                    <div class="expired-overlay">Expired</div>
                                                @endif
                                                @php
                                                    $call = new App\Http\Controllers\HomeController();
                                                    $price = $call->priceDisplay($collection->worth, $collection->status);
                                                @endphp
                                                {{ $price }}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = $collection->platforms()->get();
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}">
                                                        <li>{{ $platform->name }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <h5><a href="{{ route('loot.index', ['slug' => $collection->slug]) }}">
                                                    @if ($collection->status == 'Expired')
                                                        <strong style="color:red;">(Expired)</strong>
                                                    @endif
                                                    {{ $collection->title }}
                                                </a>
                                            </h5>
                                            <div class="col-md-12 mt-2">
                                                <div class="row">
                                                    <a
                                                        href="{{ route('collection.destroy', ['slug' => $collection->slug]) }}">
                                                        <button class="btn btn-warning"><i class="fa fa-minus"></i>
                                                            Remove</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
