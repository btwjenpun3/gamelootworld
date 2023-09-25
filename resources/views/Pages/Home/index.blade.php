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
                                    <a href="{{ route('steamIndex') }}" class="primary-btn">View All <span
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
                                                @if ($steam->worth >= 'N/A' && $steam->status == 'Active')
                                                    <div class="standard">{{ $steam->worth }}</div>
                                                @elseif($steam->status == 'Expired')
                                                    <div class="expired">Expired</div>
                                                @elseif ($steam->worth >= '0' && $steam->worth <= '4.99')
                                                    <div class="standard">${{ $steam->worth }}</div>
                                                @elseif ($steam->worth >= '5' && $steam->worth <= '9.99')
                                                    <div class="epic">${{ $steam->worth }}</div>
                                                @elseif ($steam->worth >= '10')
                                                    <div class="legendary">${{ $steam->worth }}</div>
                                                @endif
                                                {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                            <div class="view"><i class="fa fa-eye"></i> 9141</div> --}}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = explode(',', $steam->platforms);
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <li>{{ $platform }}</li>
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
                                    <a href="{{ route('epicIndex') }}" class="primary-btn">View All <span
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
                                                @if ($epic->worth == 'N/A' && $epic->status == 'Active')
                                                    <div class="standard">{{ $epic->worth }}</div>
                                                @elseif($epic->status == 'Expired')
                                                    <div class="expired">Expired</div>
                                                @elseif ($epic->worth >= '0' && $epic->worth <= '4.99')
                                                    <div class="standard">${{ $epic->worth }}</div>
                                                @elseif ($epic->worth >= '5' && $epic->worth <= '9.99')
                                                    <div class="epic">${{ $epic->worth }}</div>
                                                @elseif ($epic->worth >= '10')
                                                    <div class="legendary">${{ $epic->worth }}</div>
                                                @endif
                                                {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                            <div class="view"><i class="fa fa-eye"></i> 9141</div> --}}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = explode(',', $epic->platforms);
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <li>{{ $platform }}</li>
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
                                    <a href="{{ route('gogIndex') }}" class="primary-btn">View All <span
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
                                                @if ($gog->worth == 'N/A' && $gog->status == 'Active')
                                                    <div class="standard">{{ $gog->worth }}</div>
                                                @elseif($gog->status == 'Expired')
                                                    <div class="expired">Expired</div>
                                                @elseif ($gog->worth >= '0' && $gog->worth <= '4.99')
                                                    <div class="standard">${{ $gog->worth }}</div>
                                                @elseif ($gog->worth >= '5' && $gog->worth <= '9.99')
                                                    <div class="epic">${{ $gog->worth }}</div>
                                                @elseif ($gog->worth >= '10')
                                                    <div class="legendary">${{ $gog->worth }}</div>
                                                @endif
                                                {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                            <div class="view"><i class="fa fa-eye"></i> 9141</div> --}}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = explode(',', $gog->platforms);
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <li>{{ $platform }}</li>
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
                                    <a href="{{ route('allDlcIndex') }}" class="primary-btn">View All <span
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
                                                @if ($dlc->worth == 'N/A' && $dlc->status == 'Active')
                                                    <div class="standard">{{ $dlc->worth }}</div>
                                                @elseif($dlc->status == 'Expired')
                                                    <div class="expired">Expired</div>
                                                @elseif ($dlc->worth >= '0' && $dlc->worth <= '4.99')
                                                    <div class="standard">${{ $dlc->worth }}</div>
                                                @elseif ($dlc->worth >= '5' && $dlc->worth <= '9.99')
                                                    <div class="epic">${{ $dlc->worth }}</div>
                                                @elseif ($dlc->worth >= '10')
                                                    <div class="legendary">${{ $dlc->worth }}</div>
                                                @endif
                                                {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                            <div class="view"><i class="fa fa-eye"></i> 9141</div> --}}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = explode(',', $dlc->platforms);
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <li>{{ $platform }}</li>
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
