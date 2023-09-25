@extends('Layouts.Admin.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Posts</h4>
        <div class="card">
            <h5 class="card-header">All Game Posts</h5>
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="col-md-6 ms-4">
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('fetchPostsFromUpstream') }}" class="btn btn-secondary"><i
                                class="bi bi-download"></i>Fetch
                            Posts</a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('updatePostsFromUpstream') }}" class="btn btn-primary"><i
                                class="bi bi-download"></i>Update
                            Posts</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Published Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($posts as $post => $item)
                            <tr>
                                <td>{{ ($posts->currentPage() - 1) * $posts->perPage() + $post + 1 }}</td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <a
                                        href="{{ route('indexAdminPostEdit', ['id' => $item->id]) }}"><strong>{{ $item->title }}</strong></a>
                                </td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->published_date)->format('d F Y') }}
                                </td>
                                @if ($item->end_date == 'N/A')
                                    <td>N/A</td>
                                @else
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->end_date)->format('d F Y') }}
                                    </td>
                                @endif
                                @if ($item->end_date == 'N/A' && $item->status == 'Active')
                                    <td><span class="badge bg-label-success me-1">Active</span></td>
                                @elseif($now <= $item->end_date && $item->status == 'Active')
                                    <td><span class="badge bg-label-success me-1">Active</span></td>
                                @elseif($now >= $item->end_date || $item->status == 'Expired')
                                    <td><span class="badge bg-label-secondary me-1">Expired</span></td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card mt-5">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
