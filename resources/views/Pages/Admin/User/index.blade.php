@extends('Layouts.Admin.admin')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> User</h4>
        <div class="card">
            <h5 class="card-header">Users Management</h5>
            <div class="table-responsive text-nowrap m-3">
                <table class="table table-striped" id="users">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
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
            $('#users').DataTable({
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.datatable.users') }}',
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'created_at',
                        render: function(data) {
                            var date = new Date(data);
                            var options = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                            };
                            return date.toLocaleDateString('id-ID', options)
                        }
                    },
                    {
                        data: 'role_id',
                        render: function(data, type, row) {
                            var role_id = row.role_id;
                            if (role_id == '1') {
                                return '<span class="badge bg-label-primary">Admin</span>'
                            } else if (role_id == '2') {
                                return '<span class="badge bg-label-secondary">Member</span>'
                            }
                        }
                    },
                    {
                        data: 'status',
                        render: function(data, type, row) {
                            var status = row.status;
                            if (status == 'active') {
                                return '<span class="badge bg-label-success">Active</span>'
                            } else if (status == 'banned') {
                                return '<span class="badge bg-label-danger">Banned</span>'
                            }
                        }
                    }, {
                        data: 'id',
                        render: function(data, type, row) {
                            var id = row.id;
                            var url = '{{ route('admin.user.edit', ['id' => ':id']) }}';
                            url = url.replace(':id', id);
                            return '<a href="' + url +
                                '"><button class="btn-xs btn-primary">Edit</button></a>';
                        }
                    }

                ]
            });
        });
    </script>
@endpush
