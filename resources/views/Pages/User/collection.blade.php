@extends('Layouts.Home.home')

@section('content')
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
                        <div class="row">
                            @foreach ($collections as $collection)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <a href="{{ route('loot.index', ['slug' => $collection->slug]) }}">
                                            <div class="product__item__pic set-bg"
                                                data-setbg="{{ asset('/storage/post/images/' . $collection->image) }}">
                                                @if ($collection->worth >= 'N/A' && $collection->status == 'Active')
                                                    <div class="standard">{{ $collection->worth }}</div>
                                                @elseif($collection->status == 'Expired')
                                                    <div class="expired">Expired</div>
                                                @elseif ($collection->worth >= '0' && $collection->worth <= '4.99')
                                                    <div class="standard">${{ $collection->worth }}</div>
                                                @elseif ($collection->worth >= '5' && $collection->worth <= '9.99')
                                                    <div class="epic">${{ $collection->worth }}</div>
                                                @elseif ($collection->worth >= '10')
                                                    <div class="legendary">${{ $collection->worth }}</div>
                                                @endif
                                                {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                            <div class="view"><i class="fa fa-eye"></i> 9141</div> --}}
                                            </div>
                                        </a>
                                        <div class="product__item__text">
                                            <ul>
                                                @php
                                                    $platforms = explode(',', $collection->platforms);
                                                @endphp
                                                @foreach ($platforms as $platform)
                                                    <li>{{ $platform }}</li>
                                                @endforeach
                                            </ul>
                                            <h5><a
                                                    href="{{ route('loot.index', ['slug' => $collection->slug]) }}">{{ $collection->title }}</a>
                                            </h5>
                                            <div class="col-md-12 mt-2">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <a href="{{ route('collection.add', ['id' => $collection->id]) }}">
                                                            <button class="btn btn-secondary"><i
                                                                    class="fa fa-minus"></i></button></a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="{{ route('loot.index', ['slug' => $collection->slug]) }}"><button
                                                                class="btn btn-success">Get
                                                                Loot</button></a>
                                                    </div>
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
