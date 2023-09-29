@extends('Layouts.Admin.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> User</h4>
        <div class="card">
            <h5 class="card-header">Users Management</h5>
            <div class="col-md-6 ms-4">
                <div class="row">
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    @foreach ($users as $user => $item)
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $user + 1 }}</td>
                                <td><a href="{{ route('admin.user.edit', ['id' => $item->id]) }}">{{ $item->email }}</a>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y, H:i:s') }}</td>
                                <td>
                                    @if ($item->role_id == '1')
                                        <span class="badge bg-label-primary me-1">Admin</span>
                                    @elseif($item->role_id == '2')
                                        <span class="badge bg-label-secondary me-1">Member</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 'active')
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @elseif ($item->status == 'banned')
                                        <span class="badge bg-label-danger me-1">Banned</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
            <div class="card mt-5">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
