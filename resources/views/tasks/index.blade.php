@extends('base.base')

@section('title')
Task List
@endsection

@section('content')
<div class="container">
    <nav class="navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Navbar
                <i class="fa fa-bars" id="menu" aria-hidden="true"></i>
            </span>
        </div>
    </nav>

    <div class="d-flex justify-content-center pt-2">
     
        <!-- New Task Form -->
        <form method="POST" class="mb-3">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success')}}
                </div> 
            @endif

            
            @csrf

            <!-- Task Name -->
            <div class="mb-3">
                <label class="form-label">Task</label>
     
                <div class="mb-3">
                    <input value="{{ old('name') }}" type="text" name="name" id="task-name" class="form-control">
                    @error('name')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description')}}</textarea>
                @error('description')
                    <div class="form-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Date</label>
                
                <div class="mb-3 input-icons">
                    <i class="fa fa-calendar icon" aria-hidden="true"></i>
                    <input value="{{ old('date') }}" type="date" name="date" class="form-control" id="input-field">
                    @error('date')
                        <div class="form-text">{{ $message }}</div>
                    @enderror
                </div>
            </div>
     
            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- TODO: Current Tasks -->

    <div class="panel panel-default">
        <div class="panel-heading">
            Current Tasks
        </div>
     
        <div class="container">
            <table class="table table-striped task-table">
     
                <!-- Table Headings -->
                <thead>
                    <th>Task name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($tasks as $task )
                    <tr>
                        <!-- Task Name -->
                        <td class="table-text">
                            <div>{{ $task->name }}</div>
                        </td>
                        
                        <td class="table-text">
                            <div>{{ $task->description }}</div>
                        </td>

                        <td class="table-text">
                            <div>{{ $task->date }}</div>
                        </td>

                        <td class="table-text">
                            <button class="btn {{$task->status ? 'btn btn-outline-success' : 'btn btn-outline-danger'}}">
                                {{ $task->status ? 'Done' : 'Unrealized' }}
                            </button>
                        </td>
                        <td class="d-flex">
                      
                                <a  href="{{ route('tasks.edit', $task->id)}}" class="btn btn-outline-warning">Edit Task</a>
                                
                                <form method="POST" action="{{ route('tasks.destroy', $task->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-outline-danger">Delete Task</button>
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