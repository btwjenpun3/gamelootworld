@extends('Layouts.Admin.admin')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endpush

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
            <div class="table-responsive text-nowrap m-4">
                <table class="table table-striped" id="posts">
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
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#posts').DataTable({
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.datatable.posts') }}',
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'title',
                        render: function(data, type, row) {
                            var title = row.title;
                            var now = new Date();
                            var created_at = new Date(row.created_at);
                            created_at.setMinutes(created_at.getMinutes() + 1);
                            if (now <= created_at) {
                                return title + '<span class="badge bg-label-danger">New</span>';
                            } else {
                                return title;
                            }
                        }
                    },
                    {
                        data: 'published_date',
                    },
                    {
                        data: 'end_date',
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = row.status;
                            if (status == 'Active') {
                                return '<span class="badge bg-label-success">Active</span>';
                            } else {
                                return '<span class="badge bg-label-secondary">Expired</span>';
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            var id = row.id;
                            var url = '{{ route('admin.posts.edit', ['id' => ':id']) }}';
                            url = url.replace(':id', id);
                            return '<a href="' + url +
                                '"><button class="btn-xs btn-primary">Edit</button></a>';
                        }
                    }
                ],
                order: [
                    // Urutkan berdasarkan kolom 'created_id' secara menaik (asc)
                    [0, 'desc'] // Ganti dengan indeks kolom 'created_id' yang sesuai
                ]
            });
        });
    </script>
@endpush
