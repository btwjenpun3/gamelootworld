@extends('Layouts.Admin.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Post / </span>{{ $title }}</h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Fetch from Source ID</h5>
                    </div>
                    <div class="card-body">
                        <div id="not_found"></div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="id">Source ID</label>
                            <div class="col-sm-10">
                                <input type="text" name="id"
                                    class="form-control @error('title') is-invalid @enderror" id="id"
                                    placeholder="ex. 2150" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary" onclick="editData()">Fetch</button>
                            </div>
                        </div>
                        <script>
                            function editData() {
                                var sourceId = document.getElementById('id').value;
                                var url = "{{ route('admin.tools.fetch.id') }}"
                                $.ajax({
                                    url: url + "/" + sourceId,
                                    type: 'get',
                                    success: function(response) {
                                        console.log(response);
                                        document.getElementById('source_id').value = response.id;
                                        document.getElementById('title').value = response.title;
                                        document.getElementById('worth').value = response.worth;
                                        document.getElementById('platforms').value = response.platforms;
                                        document.getElementById('description').value = response.description;
                                        document.getElementById('instructions').value = response.instructions;
                                        document.getElementById('type').value = response.type;
                                        document.getElementById('image').src = response.image;
                                        document.getElementById('image_form').value = response.image;
                                        document.getElementById('thumbnail').value = response.thumbnail;
                                        document.getElementById('original_url').value = response.open_giveaway_url;
                                        document.getElementById('redirect_url').value = response.redirect_url;
                                        document.getElementById('published_date').value = response.published_date;
                                        document.getElementById('end_date').value = response.end_date;
                                    },
                                    error: function(xhr, error, status) {
                                        var errorMessage = document.createElement(
                                            "div");
                                        errorMessage.className = "alert alert-warning";
                                        errorMessage.textContent = xhr.responseJSON.message;
                                        $('#not_found').html(errorMessage);
                                        setTimeout(function() {
                                            errorMessage.remove();
                                        }, 7000);
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">or Fill the Forms Below</h5>
                        <small class="text-muted float-end">Make sure your new data are correct</small>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="source_id" name="source_id">
                            <input type="hidden" id="thumbnail" name="thumbnail">
                            <input type="hidden" id="type" name="type">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-title">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror" id="basic-default-title"
                                        placeholder="Title" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-worth">Price ($)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="worth" id="worth"
                                        class="form-control @error('worth') is-invalid @enderror" id="basic-default-worth"
                                        placeholder="Worth" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-platforms">Platforms</label>
                                <div class="col-sm-10">
                                    <input type="text" name="platforms" id="platforms"
                                        class="form-control @error('platforms') is-invalid @enderror"
                                        id="basic-default-platforms" placeholder="Platforms" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        id="basic-default-description" placeholder="description" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-instructions">Instruction</label>
                                <div class="col-sm-10">
                                    <textarea name="instructions" id="instructions" class="form-control @error('instructions') is-invalid @enderror"
                                        id="basic-default-instructions" placeholder="Instructions" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-original-url">Original URL</label>
                                <div class="col-sm-10">
                                    <input type="text" name="original_url" id="original_url"
                                        class="form-control @error('original_url') is-invalid @enderror"
                                        id="basic-default-original-url" placeholder="Original URL" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-redirect-url">Redirect
                                    URL</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="basic-default-redirect-url"
                                                placeholder="Redirect URL" disabled>
                                        </div>
                                        <div class="col-sm-1">
                                            <h3 class="mt-1">/</h3>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" name="redirect_url" id="redirect_url"
                                                class="form-control @error('redirect_url') is-invalid @enderror"
                                                id="basic-default-redirect-url" placeholder="Redirect URL" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-published-date">Published
                                    Date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="published_date" id="published_date"
                                        class="form-control @error('published_date') is-invalid @enderror"
                                        id="basic-default-published-date" placeholder="Published Date" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-end-date">End
                                    Date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end_date" id="end_date"
                                        class="form-control @error('end_date') is-invalid @enderror"
                                        id="basic-default-end-date" placeholder="End Date" />
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
                                            id="flexSwitchCheckChecked2" value="Expired">
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>
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
                        <img id="image">
                        <div class="mt-3">
                            <input class="form-control" type="file" name="image" />
                            <input type="hidden" id="image_form" name="image">
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!-- Controls -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
