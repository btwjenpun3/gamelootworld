@extends('Layouts.Home.home')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> Home</a>
                        <span>{{ $platform }}</span>
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

                        </h1>
                        <h5 class="mb-3">

                        </h5>

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
                                    <h4>{{ $title }} : {{ $platform }}<span> ({{ $datas->count() }})</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($datas as $data)
                                <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
                                    <div class="product__item">
                                        <a href="{{ route('loot.index', ['slug' => $data->slug]) }}">
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ asset('/storage/post/images/' . $data->image) }}">
                                                @if ($data->worth >= 'N/A' && $data->status == 'Active')
                                                    <div class="standard">{{ $data->worth }}</div>
                                                @elseif($data->status == 'Expired')
                                                    <div class="expired">Expired</div>
                                                @elseif ($data->worth >= '0' && $data->worth <= '4.99')
                                                    <div class="standard">${{ $data->worth }}</div>
                                                @elseif ($data->worth >= '5' && $data->worth <= '9.99')
                                                    <div class="epic">${{ $data->worth }}</div>
                                                @elseif ($data->worth >= '10')
                                                    <div class="legendary">${{ $data->worth }}</div>
                                                @endif
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $get_platforms = explode(',', $data->platforms);
                                                    $platforms = \App\Models\Platform::whereIn('name', array_map('trim', $get_platforms))->get();
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <a href="{{ $platform->slug }}">
                                                        <li>{{ $platform->name }}</li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <h5><a
                                                    href="{{ route('loot.index', ['slug' => $data->slug]) }}">{{ $data->title }}</a>
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
