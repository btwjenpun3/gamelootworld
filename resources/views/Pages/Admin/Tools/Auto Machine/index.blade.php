@extends('Layouts.Admin.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Tools /</span> {{ $title }}</h4>
        <div class="row">
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Update Posts</h5>
                        <small class="text-muted float-end">Recomended to run it daily</small>
                    </div>
                    <div class="ms-4">
                        <div id="update_result"></div>
                        <p>This tool will update your posts, checking the last of <code>source_id</code> from your
                            database,
                            and pull <code>published_date</code> and compare to upstream. </p>
                        <p>If upstream has newer posts data,
                            it will auto pull to database. </p>
                    </div>
                    <div class="ms-4 mb-4">
                        <button class="btn btn-primary" id="updateButton" onclick="postsUpdate()"> Update Posts </button>
                        <script>
                            function postsUpdate() {
                                var updateButton = document.getElementById('updateButton');
                                updateButton.innerHTML = 'Updating...';
                                updateButton.disabled = true;
                                $.ajax({
                                    url: '/data/update',
                                    method: 'get',
                                    success: function(response) {
                                        var successMessage = document.createElement(
                                            "div");
                                        successMessage.className = "alert alert-success";
                                        successMessage.textContent = response.title;
                                        $('#update_result').html(successMessage);
                                        setTimeout(function() {
                                            successMessage.remove();
                                        }, 7000);
                                        updateButton.innerHTML = 'Update Posts';
                                        updateButton.disabled = false;
                                    },
                                    error: function(xhr, error, status) {
                                        var errorMessage = document.createElement(
                                            "div");
                                        errorMessage.className = "alert alert-warning";
                                        errorMessage.textContent = xhr.responseJSON.message;
                                        $('#update_result').html(errorMessage);
                                        setTimeout(function() {
                                            errorMessage.remove();
                                        }, 7000);
                                        updateButton.innerHTML = 'Update Posts';
                                        updateButton.disabled = false;
                                    }
                                })
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Update Post Status</h5>
                        <small class="text-muted float-end">Make sure your new data are correct</small>
                    </div>
                    <div class="ms-4">
                        <div id="status_result"></div>
                        <p>This tool will check your <code>current_date</code> and <code>end_date</code>.</p>
                        <p>If your <code>current_date</code> more than <code>end_date</code>, then post status will change
                            from <code>Active</code> to <code> Expired</code>. </p>
                        <p>Recomended run it once after Fetch All Posts!</p>
                    </div>
                    <div class="ms-4 mb-4">
                        <button class="btn btn-primary" id="statusButton" onclick="updateStatus()">Update
                            Status</button>
                        <script>
                            function updateStatus() {
                                var statusButton = document.getElementById('statusButton');
                                statusButton.innerHTML = 'Updating...';
                                statusButton.disabled = true;
                                $.ajax({
                                    url: '/data/status/update',
                                    method: 'get',
                                    success: function(response) {
                                        var successMessage = document.createElement(
                                            "div");
                                        successMessage.className = "alert alert-success";
                                        successMessage.textContent = response.message;
                                        $('#status_result').html(successMessage);
                                        setTimeout(function() {
                                            successMessage.remove();
                                        }, 7000);
                                        statusButton.innerHTML = 'Update Status';
                                        statusButton.disabled = false;
                                    },
                                    error: function(xhr, error, status) {
                                        var errorMessage = document.createElement(
                                            "div");
                                        errorMessage.className = "alert alert-warning";
                                        errorMessage.textContent = xhr.responseJSON.message;
                                        $('#status_result').html(errorMessage);
                                        setTimeout(function() {
                                            errorMessage.remove();
                                        }, 7000);
                                        statusButton.innerHTML = 'Update Status';
                                        statusButton.disabled = false;
                                    }
                                })
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Fetch All Posts</h5>
                        <small class="text-muted float-end">Run it once!</small>
                    </div>
                    <div class="ms-4">
                        <div id="fetch_result"></div>
                        <p><b>Warning!</b></p>
                        <p>Just run it once when site already initialize for first time!</p>
                        <p>If you run it on running site, your data will be duplicate and you cannot undo this!</p>
                    </div>
                    <div class="ms-4 mb-4">
                        @if (isset($status->status))
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <button class="btn btn-warning">Reset</button>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <p><i>Already fetched at {{ $status->created_at }}. Please click 'Reset' if you wish
                                                fetch again.</i></p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <button class="btn btn-danger" id="fetch" onclick="fetch()">Fetch All</button>
                            <script>
                                function fetch() {
                                    var fetch = document.getElementById('fetch');
                                    fetch.innerHTML = 'Updating...';
                                    fetch.disabled = true;
                                    $.ajax({
                                        url: '/data/fetch',
                                        method: 'get',
                                        success: function(response) {
                                            var successMessage = document.createElement(
                                                "div");
                                            successMessage.className = "alert alert-success";
                                            successMessage.textContent = response.message;
                                            $('#fetch_result').html(successMessage);
                                            setTimeout(function() {
                                                successMessage.remove();
                                            }, 7000);
                                            fetch.innerHTML = 'Fetch All';
                                            fetch.disabled = false;
                                        },
                                        error: function(xhr, error, status) {
                                            var errorMessage = document.createElement(
                                                "div");
                                            errorMessage.className = "alert alert-warning";
                                            errorMessage.textContent = xhr.responseJSON.message;
                                            $('#fetch_result').html(errorMessage);
                                            setTimeout(function() {
                                                errorMessage.remove();
                                            }, 7000);
                                            fetch.innerHTML = 'Fetch All';
                                            fetch.disabled = false;
                                        }
                                    })
                                }
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
