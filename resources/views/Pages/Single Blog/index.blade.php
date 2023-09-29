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

    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('/storage/post/images/' . $image) }}">
                            {{-- <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div> --}}
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $title }} </h3>
                                <span>{{ $platforms }}</span>
                            </div>
                            <div class="price__item__pic">
                                @if ($worth == 'N/A')
                                    <div class="standard">{{ $worth }}</div>
                                @elseif ($worth >= '0' && $worth <= '4.99')
                                    <div class="standard">${{ $worth }}</div>
                                @elseif ($worth >= '5' && $worth <= '9.99')
                                    <div class="epic">${{ $worth }}</div>
                                @elseif ($worth >= '10')
                                    <div class="legendary">${{ $worth }}</div>
                                @endif
                            </div>
                            <p>{{ $description }}</p>
                            <div class="anime__details__text mb-3">
                                <h4><b>Instructions :</b></h4>
                            </div>
                            <ol>
                                @foreach ($instructions as $instruction)
                                    <li>{!! html_entity_decode(trim($instruction)) !!}</li>
                                @endforeach
                            </ol>
                            <div class="anime__details__btn mt-4">
                                @if ($status == 'Active')
                                    <a href="/go/{{ $redirect_url }}" target="_blank" class="follow-btn"><i
                                            class="fa fa-download"></i> Claim Now</a>
                                @elseif($status == 'Expired')
                                    <a href="#" class="expired-btn">
                                        Expired</a>
                                @endif
                                <a href="#" class="watch-btn" disabled><span>Expired on :
                                        @if ($expired_on == 'N/A')
                                            N/A
                                        @else
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expired_on)->format('d F Y') }}
                                        @endif
                                    </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Comments</h5>
                        </div>
                        @foreach ($comments as $comment)
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="img/anime/review-1.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>{{ $comment->user->name }} -
                                        <span>{{ $comment->diffTime }}</span>
                                    </h6>
                                    <p>{{ $comment->comments }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        @if (auth()->check())
                            <form action="{{ route('comment.store', ['id' => $id]) }}" method="post">
                                @csrf
                                <textarea placeholder="Your Comment" name="comment"></textarea>
                                <input type="hidden" name="slug" value="{{ $slug }}">
                                <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                            </form>
                        @else
                            <a href="{{ route('login.index') }}"><button class="btn btn-primary"><i class="fa fa-lock"></i>
                                    Please Login
                                    First</button></a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>you might like...</h5>
                        </div>
                        @foreach ($related_posts as $post)
                            <div class="product__sidebar__view__item set-related-bg"
                                data-serelatedtbg="{{ asset('/storage/post/images/' . $post->image) }}">
                                <h5><a href="/{{ $post->slug }}">{{ $post->title }}</a></h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
