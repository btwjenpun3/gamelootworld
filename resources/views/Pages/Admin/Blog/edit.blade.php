@extends('Layouts.Admin.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Post / Edit /</span> {{ $post->title }}</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit from Form below</h5>
                        <small class="text-muted float-end">Make sure your new data are correct</small>
                    </div>
                    <div class="card-body">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('admin.posts.update', ['id' => $post->id]) }}">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-title">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" id="basic-default-title"
                                        placeholder="Title" value="{{ $post->title }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-worth">Price ($)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="worth"
                                        class="form-control @error('worth') is-invalid @enderror" id="basic-default-worth"
                                        placeholder="Worth" value="{{ $post->worth }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-worth">Type</label>
                                <div class="col-sm-10">
                                    <select type="text" name="type"
                                        class="form-control @error('worth') is-invalid @enderror">
                                        <option value="Game" @if ($post->type == 'Game') selected @endif>Game
                                        </option>
                                        <option value="DLC" @if ($post->type == 'DLC') selected @endif>DLC
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-platforms">Platforms</label>
                                <div class="col-sm-10">
                                    <input type="text" name="platforms"
                                        class="form-control @error('platforms') is-invalid @enderror"
                                        id="basic-default-platforms" placeholder="Platforms"
                                        value="{{ $post->platforms }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                        id="basic-default-description" placeholder="description" rows="5">{{ $post->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-instructions">Instruction</label>
                                <div class="col-sm-10">
                                    <textarea name="instructions" class="form-control @error('instructions') is-invalid @enderror"
                                        id="basic-default-instructions" placeholder="Instructions" rows="5">{{ $post->instructions }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-original-url">Original URL</label>
                                <div class="col-sm-10">
                                    <input type="text" name="original_url"
                                        class="form-control @error('original_url') is-invalid @enderror"
                                        id="basic-default-original-url" placeholder="Original URL"
                                        value="{{ $post->open_giveaway_url }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-redirect-url">Redirect URL</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="basic-default-redirect-url"
                                                placeholder="Redirect URL" value="{{ env('APP_URL') }}" disabled>
                                        </div>
                                        <div class="col-sm-1">
                                            <h3 class="mt-1">/</h3>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" name="redirect_url"
                                                class="form-control @error('redirect_url') is-invalid @enderror"
                                                id="basic-default-redirect-url" placeholder="Redirect URL"
                                                value="{{ $post->redirect_url }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-published-date">Published
                                    Date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="published_date"
                                        class="form-control @error('published_date') is-invalid @enderror"
                                        id="basic-default-published-date" placeholder="Published Date"
                                        value="{{ $post->published_date }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-end-date">End
                                    Date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        id="basic-default-end-date" placeholder="End Date"
                                        value="{{ $post->end_date }}" />
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3 col-form-label">
                                        <p>Toggle</p>
                                    </div>
                                    <div class="form-check form-switch mb-3 col-md-4 mt-1">
                                        <label class="form-check-label" for="flexSwitchCheckChecked1">Featured</label>
                                        <input class="form-check-input" name="featured" type="checkbox"
                                            id="flexSwitchCheckChecked1" />
                                    </div>
                                    <div class="form-check form-switch mb-3 col-md-4 mt-1">
                                        <label class="form-check-label" for="flexSwitchCheckChecked2">Expired</label>
                                        <input class="form-check-input" name="status" type="checkbox"
                                            id="flexSwitchCheckChecked2" value="Expired"
                                            @if ($post->status == 'Expired') checked 
                                            @elseif($post->status == 'Active') unchecked @endif />
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Image -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Post Image</h5>
                    </div>
                    <div class="card-body">
                        <p>Recomended size : <b>460x215</b> px</p>
                        <img src="{{ asset('/storage/post/images/' . $post->image) }}" width="460px" height="215px">
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Links</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <p>Source ID : <strong>{{ $post->source_id }}</strong> </p>
                                <p>Original Source : <a href="{{ $source_url }}"
                                        target="_blank">{{ $source_url }}</a></p>
                                <p>Original URL : <a href="{{ $post->open_giveaway_url }}"
                                        target="_blank">{{ $post->open_giveaway_url }}</a></p>
                                <p>Redirect URL : <a href="{{ $url }}/go/{{ $post->redirect_url }}"
                                        target="_blank">{{ $url }}/go/{{ $post->redirect_url }}</a></p>
                                <p>View Post : <a href="{{ route('loot.index', ['slug' => $post->slug]) }}"
                                        target="_blank">{{ route('loot.index', ['slug' => $post->slug]) }}</a></p>
                                <div class="mb-3 mt-3">
                                    <h5 class="mb-0">Action</h5>
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('admin.posts.destroy', ['id' => $post->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Controls -->
        </div>
    </div>
@endsection
