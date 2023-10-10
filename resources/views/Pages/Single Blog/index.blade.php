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
                @if (session()->has('title'))
                    <div class="alert alert-success">
                        <strong>{{ session('title') }}</strong> was added to your collections.
                    </div>
                @endif
                @if (session()->has('single_page_title'))
                    <div class="alert alert-warning">
                        <strong>{{ session('single_page_title') }}</strong> was removed from your collections.
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ asset('/storage/post/images/' . $image) }}">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>
                                    @if ($status == 'Expired')
                                        <strong style="color:red;">(Expired)</strong>
                                    @endif
                                    {{ $title }}
                                </h3>
                                @if (isset($collection))
                                    <a href="{{ route('collection.single_page_destroy', ['slug' => $slug]) }}">
                                        <button class="btn btn-outline-secondary mb-3">
                                            Remove from Collection
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('collection.add', ['slug' => $slug]) }}">
                                        <button class="btn btn-outline-secondary mb-3">
                                            <i class="fa fa-bookmark"></i> Add to Collection
                                        </button>
                                    </a>
                                @endif
                                <span>
                                    @foreach ($platforms as $platform)
                                        <a href="{{ route('platforms.index', ['slug' => $platform->slug]) }}"
                                            style="list-style: none;
                                            font-size: 12px;
                                            color: #ffffff;
                                            font-weight: 700;
                                            padding: 1px 10px;
                                            background: rgba(255, 255, 255, 0.2);
                                            border-radius: 50px;
                                            display: inline-block;">
                                            {{ $platform->name }}
                                        </a>
                                    @endforeach
                                </span>
                            </div>
                            <div class="price__item__pic">
                                @php
                                    $call = new App\Http\Controllers\HomeController();
                                    $price = $call->priceDisplay($worth, $status);
                                @endphp
                                {{ $price }}
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
                                    <a href="{{ route('redirect', ['url' => $redirect_url]) }}" target="_blank"
                                        class="follow-btn"><i class="fa fa-download"></i> Claim Now</a>
                                @elseif($status == 'Expired')
                                    <a href="#" class="expired-btn"> Expired</a>
                                @endif
                                <button class="btn watch-btn" disabled>
                                    <span>Expired on :
                                        @if ($expired_on == 'N/A')
                                            N/A
                                        @else
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $expired_on)->format('d F Y') }}
                                        @endif
                                    </span>
                                </button>
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
                                    @if ($comment->status == 'approved')
                                        <p> {{ $comment->comments }}</p>
                                    @elseif($comment->status == 'declined')
                                        <p><i>Comment Declined</i></p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        @if (auth()->check())
                            @error('comment')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <form action="{{ route('comment.store', ['id' => $id]) }}" method="post">
                                @csrf
                                <textarea placeholder="Your Comment" name="comment"></textarea>
                                <input type="hidden" name="slug" value="{{ $slug }}">
                                <button type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                            </form>
                        @else
                            <a href="{{ route('login.index') }}"><button class="btn btn-primary"><i class="fa fa-lock"></i>
                                    Please Login First</button></a>
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
                                <h5><a href="{{ route('loot.index', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
