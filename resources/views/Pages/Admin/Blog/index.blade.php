@extends('Layouts.Admin.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Posts</h4>
        <div class="card">
            <h5 class="card-header">All Game Posts</h5>
            <div class="col-md-6 ms-4">
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">New
                            Post</a>
                    </div>
                </div>
            </div>
            @if (session()->has('deleted'))
                <div class="alert alert-warning col-md-6 ms-3">{{ session('deleted') }}</div>
            @endif
            @if (session()->has('created'))
                <div class="alert alert-success col-md-6 ms-3">{{ session('created') }}</div>
            @endif
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
                                    <a href="{{ route('admin.posts.edit', ['id' => $item->id]) }}"><strong>{{ $item->title }}</strong>
                                        @if ($now <= \Carbon\Carbon::parse($item->created_at)->addMinutes(5))
                                            <span class="badge bg-label-danger me-1">New</span>
                                        @endif
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->published_date)->format('d F Y') }}
                                </td>
                                @if ($item->end_date == 'N/A')
                                    <td>N/A</td>
                                @else
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->end_date)->format('d F Y') }}
                                    </td>
                                @endif
                                @if ($item->status == 'Active')
                                    <td><span class="badge bg-label-success me-1">Active</span></td>
                                @elseif($item->status == 'Expired')
                                    <td><span class="badge bg-label-secondary me-1">Expired</span></td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.posts.edit', ['id' => $item->id]) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
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
