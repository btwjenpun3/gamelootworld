@extends('Layouts.Home.home')

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ route('index') }}"><i class="fa fa-home"></i> Home</a>
                        <span>{{ $title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <section class="product spad">
        <div class="container">
            {{-- Steam Games --}}
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
                                                {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                            <div class="view"><i class="fa fa-eye"></i> 9141</div> --}}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = explode(',', $data->platforms);
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <li>{{ $platform }}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a href="/{{ $data->slug }}">{{ $data->title }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $datas->links() }}
                    </div>
                </div>
            </div>
            {{-- Steam Games --}}
        </div>
    </section>
@endsection
