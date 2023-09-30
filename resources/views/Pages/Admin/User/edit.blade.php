@extends('Layouts.Admin.admin')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users / Edit /</span> {{ $user->email }}</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit from Form below</h5>
                        <small class="text-muted float-end">Make sure your new data are correct</small>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session()->has('failed'))
                            <div class="alert alert-danger">{{ session('failed') }}</div>
                        @endif
                        <form action="{{ route('admin.user.update', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control mb-3" name="name" id="name"
                                    placeholder="John Doe" aria-describedby="name" value="{{ $user->name }}" />
                            </div>
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control mb-3" name="email" id="email"
                                    placeholder="admin@admin.com" aria-describedby="email" value="{{ $user->email }}" />
                            </div>
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control mb-3" name="password" id="password"
                                    aria-describedby="password" />
                            </div>
                            <div>
                                <label for="role_id" class="form-label">Role</label>
                                <select class="form-control mb-3" name="role_id" id="role_id" aria-describedby="role_id">
                                    <option value="1" @if ($user->role_id == '1') selected ( @endif)>Admin
                                    </option>
                                    <option value="2" @if ($user->role_id == '2') selected ( @endif)>Member
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control mb-3" name="status" id="status" aria-describedby="status">
                                    <option value="active" @if ($user->status == 'active') selected ( @endif)>Active
                                    </option>
                                    <option value="banned" @if ($user->status == 'banned') selected ( @endif)>Banned
                                    </option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
