@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Task List App</h1>

    <div class="offset-md-2 col-md-8">
        <div class="card">
            @if (isset($task))
            <div class="card-header">
                Update Task
            </div>
            <div class="card-body">
                <!-- Update Task Form -->
                <form action="{{ route('update-task') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}">
                    <div class="mb-3">
                        <label for="task-name" class="form-label">Task</label>
                        <input type="text" name="name" id="task-name" class="form-control" value="{{ $task->name }}">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus me-2"></i>Update Task
                        </button>
                    </div>
                </form>
            </div>
            @else
            <div class="card-header">
                New Task
            </div>
            <div class="card-body">
                <!-- New Task Form -->
                <form action="{{ route('create-task') }}" method="GET">
                    @csrf
                    <div class="mb-3">
                        <label for="task-name" class="form-label">Task</label>
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus me-2"></i>Add Task
                    </button>
                </form>
            </div>
            @endif
        </div>

        <!-- Current Tasks -->
        <div class="card mt-4">
            <div class="card-header">
                Current Tasks
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td>
                                <!-- Delete Task -->
                                <form action="{{ route('delete-task', ['id' => $task->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash me-2"></i>Delete
                                    </button>
                                </form>

                                <!-- Edit Task (Form opens on click) -->
                                <form action="{{ route('edit-task', ['id' => $task->id]) }}" method="GET" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-edit me-2"></i>Edit
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
