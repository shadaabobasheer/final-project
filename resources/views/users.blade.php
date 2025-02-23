@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Users List</h1>
    <div class="offset-md-2 col-md-8">
        <div class="card">
            @if (isset($user))
            <div class="card-header">
                Update User
            </div>
            <div class="card-body">
                <!-- Update User Form -->
                <form action="{{ url('create-user') }}" method="POST">
    @csrf
    <!-- User Name -->
    <div class="mb-3">
        <label for="user-name" class="form-label">Name</label>
        <input type="text" name="name" id="user-name" class="form-control" value="none">
    </div>
    <!-- User Email -->
    <div class="mb-3">
        <label for="user-email" class="form-label">Email</label>
        <input type="email" name="email" id="user-email" class="form-control" value="none@example.com">
    </div>
    <!-- User Password -->
    <div class="mb-3">
        <label for="user-password" class="form-label">Password</label>
        <input type="password" name="password" id="user-password" class="form-control" value="none">
    </div>
    <!-- Add User Button -->
    <div>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-plus me-2"></i>Add User
        </button>
    </div>
</form>

            </div>

            @else
            <div class="card-header">
                New User
            </div>
            <div class="card-body">
                <!-- New User Form -->
                <form action="{{ url('create-user') }}" method="POST">
                    @csrf
                    <!-- User Name -->
                    <div class="mb-3">
                        <label for="user-name" class="form-label">Name</label>
                        <input type="text" name="name" id="user-name" class="form-control" value="">
                    </div>
                    <!-- User Email -->
                    <div class="mb-3">
                        <label for="user-email" class="form-label">Email</label>
                        <input type="email" name="email" id="user-email" class="form-control" value="">
                    </div>
                    <!-- User Password -->
                    <div class="mb-3">
                        <label for="user-password" class="form-label">Password</label>
                        <input type="password" name="password" id="user-password" class="form-control" value="">
                    </div>
                    <!-- Add User Button -->
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Add User
                        </button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>

    <!-- Current Users -->
    <div class="card mt-4">
        <div class="card-header">
            Current Users
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td>
                        <!-- زر الحذف -->
                        <form action="/delete-user/{{ $user->id }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash me-2"></i>Delete
                            </button>
                        </form>

                        <!-- زر التعديل -->
                        <form action="/edit-user/{{ $user->id }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-info me-2"></i>Edit
                            </button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
