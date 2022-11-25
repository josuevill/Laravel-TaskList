@extends('base.base')

@section('content')
<div class="container pt-3">
    <a class="btn btn-outline-primary" href="{{ route('tasks.index')}}">Return</a>
</div>

<div class="d-flex justify-content-center pt-2">
    <form method="POST" class="mb-3" action="{{ route('tasks.update', $task->id) }}">
        @method('PUT')
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
                <input value="{{ old('name') ?? $task->name}}" type="text" name="name" id="task-name" class="form-control">
                @error('name')
                    <div class="form-text">{{ $message }}</div>
                @enderror
            </div>

        </div>
        
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description') ?? $task->description }}</textarea>
            @error('description')
                <div class="form-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Is done</label>
            <select name="status" class="form-control">
                <option value="0">Done</option>
                <option value="1">Unrealized</option>
            </select>
            @error('description')
                <div class="form-text">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Date</label>
            
            <div class="mb-3 input-icons">
                <i class="fa fa-calendar icon" aria-hidden="true"></i>
                <input value="{{ old('date') ?? $task->date }}" type="date" name="date" class="form-control" id="input-field">
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