@extends('Layouts.Home.home')

@section('slider')
    @include('Partials.slider')
@endsection

@section('content')
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>{{ $title }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($datas as $data)
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
                                    <div class="product__item">
                                        <a href="{{ route('loot.index', ['slug' => $data->slug]) }}">
                                            @if (auth()->check())
                                                @php
                                                    $collection = $data
                                                        ->users()
                                                        ->where('user_id', auth()->id())
                                                        ->first();
                                                @endphp
                                                @if (isset($collection) && $collection->id === auth()->id())
                                                    <div class="product__item__pic set-bg @if ($data->status == 'Expired') expired @endif"
                                                        data-setbg="{{ asset('/storage/post/images/' . $data->image) }}"
                                                        style="filter:grayscale(1);">
                                                    @else
                                                        <div class="product__item__pic set-bg @if ($data->status == 'Expired') expired @endif"
                                                            data-setbg="{{ asset('/storage/post/images/' . $data->image) }}">
                                                @endif
                                            @else
                                                <div class="product__item__pic set-bg @if ($data->status == 'Expired') expired @endif"
                                                    data-setbg="{{ asset('/storage/post/images/' . $data->image) }}">
                                            @endif
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
                                        <h5>
                                            <a href="{{ route('loot.index', ['slug' => $data->slug]) }}">
                                                @if ($data->status == 'Expired')
                                                    <strong style="color:red;">(Expired)</strong>
                                                @endif
                                                {{ $data->title }}
                                            </a>
                                        </h5>
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
