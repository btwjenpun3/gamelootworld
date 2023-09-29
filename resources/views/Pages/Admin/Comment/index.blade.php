@extends('Layouts.Admin.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Comments</h4>
        <div class="card">
            <h5 class="card-header">Comments Management</h5>
            <div class="col-md-6 ms-4">
                <div class="row">
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>in Post</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    @foreach ($comments as $comment => $item)
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>{{ ($comments->currentPage() - 1) * $comments->perPage() + $comment + 1 }}</td>
                                <td><a href="{{ route('admin.user.edit', ['id' => $item->user->id]) }}"
                                        target="_blank">{{ $item->user->name }}</a></td>
                                <td>{{ $item->comments }}</td>
                                <td><a href="{{ route('loot.index', ['slug' => $item->post->slug]) }}"
                                        target="_blank">{{ $item->post->title }}</a>
                                </td>
                                <td>{{ $item->diffTime }}</td>
                                <td>
                                    @if ($item->status == 'approved')
                                        <span class="badge bg-label-success me-1">Approved</span>
                                    @elseif($item->status == 'declined')
                                        <span class="badge bg-label-danger me-1">Declined</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="card mt-5">
                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection
