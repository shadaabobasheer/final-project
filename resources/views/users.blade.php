@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>User List App</h1>
    <div class="offset-md-2 col-md-8">
        <div class="card">
            @if (isset($user))
            <div class="card-header">
                Update User
            </div>
            <div class="card-body">
                <!-- Update User Form -->
                <form action="{{url('update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <!-- User Name -->
                    <div class="mb-3">
                        <label for="user-name" class="form-label">Task</label>
                        <input type="text" name="name" id="user-name" class="form-control" value="{{$user->name}}">
                        <input type="email" name="email" id="user-email" class="form-control" value="{{$user->email}}">
                        <input type="password" name="password" id="user-password" class="form-control" value="{{$user->password}}">

                    </div>
                    <!-- Update User Button -->
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Update User
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
                <form action="{{ url('create-user') }}" method="GET">
                    @csrf
                    <div class="mb-3">
                        <label for="user-name" class="form-label">Name</label>
                        <input type="text" name="name" id="user-name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="user-email" class="form-label">Email</label>
                        <input type="email" name="email" id="user-email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="user-password" class="form-label">Password</label>
                        <input type="password" name="password" id="user-password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i> Add User
                    </button>
                </form>

            </div>
            @endif
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
                            <td>{{$user->name}}</td>
                            <td>
                                <form action="/delete/{{$user->id}}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash me-2"></i>Delete
                                    </button>
                                </form>
                                <form action="/edit/{{$user->id}}" method="POST" class="d-inline">
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
</div>
@endsection
