@extends('backend.master')
@section('title')
Admin :: Pending User List
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Admin Management</h3>
            </div>
            <div class="card-body">
                <button class="btn btn-orange btn-sm mb-3" onclick="history.back();"><i class="fa fa-mail-reply"></i> Go Back</button>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-blue mb-3">
                    <i class="fa fa-mail-reply"></i> Back to Dashboard
                </a>
                <div class="table-responsive">
                    <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>BMDC No:</th>
                                <th>NID No:</th>
                                <th>Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pending_user as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->bmdc_number ?? '' }}</td>
                                <td>{{ $user->nid_number ?? '' }}</td>
                                <td>
                                    @if ($user->role == 2)
                                    <div class="mt-sm-1 d-block">
                                        <span class="tag tag-rounded">Super Admin</span>
                                    </div>
                                    @elseif($user->role == 1)
                                    <div class="mt-sm-1 d-block">
                                        <span class="tag tag-rounded text-primary">Admin</span>
                                    </div>
                                    @else
                                    <div class="mt-sm-1 d-block">
                                        <span class="tag tag-rounded text-danger">Not Admin</span>
                                    </div>
                                    @endif
                                </td>
                                <td name="bstable-actions">
                                    <div class="btn-list" style="display: flex;">
                                        @if ($user->role == 0)
                                        <a class="btn btn-sm btn-success" href="{{ route('role', ['id' => $user->id, 'newRole' => 1]) }}" data-bs-toggle="tooltip" data-bs-original-title="Make Admin">
                                            <span class="fe fe-check-circle"> </span> Admin
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('role', ['id' => $user->id, 'newRole' => 2]) }}" data-bs-toggle="tooltip" data-bs-original-title="Make Super Admin">
                                            <span class="fe fe-check-circle"> </span> Super Admin
                                        </a>
                                        @elseif($user->role == 1)
                                        <a class="btn btn-sm btn-danger" href="{{ route('role', ['id' => $user->id, 'newRole' => 0]) }}" data-bs-toggle="tooltip" data-bs-original-title="Remove Admin">
                                            <span class="fe fe-user-x"> </span> Admin
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('role', ['id' => $user->id, 'newRole' => 2]) }}" data-bs-toggle="tooltip" data-bs-original-title="Make Super Admin">
                                            <span class="fe fe-check-circle"> </span> Super Admin
                                        </a>
                                        @elseif($user->role == 2)
                                        <a class="btn btn-sm btn-danger" href="{{ route('role', ['id' => $user->id, 'newRole' => 0]) }}" data-bs-toggle="tooltip" data-bs-original-title="Remove Super Admin">
                                            <span class="fe fe-user-x"> </span> Super Admin
                                        </a>
                                        <a class="btn btn-sm btn-success" href="{{ route('role', ['id' => $user->id, 'newRole' => 1]) }}" data-bs-toggle="tooltip" data-bs-original-title="Make Admin">
                                            <span class="fe fe-check-circle"> </span> Admin
                                        </a>
                                        @endif
                                        <form action="{{ route('delete_admin', ['id' => $user->id]) }}" method="post">
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');" type="submit" data-bs-toggle="tooltip" data-bs-original-title="Delete User"> <span class="fe fe-trash-2"> </span> User</button>
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
