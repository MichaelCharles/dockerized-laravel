@extends('layout')

@section('title')
Project - {{ $project->title }}
@endsection

@section('content')
    <h1 class="title">{{ $project->title }}</h1>
    <div class="box">
    <p>{{ $project->description }}</p>
        <a href="/projects"><button class="button">Return</button></a> <a href="/projects/{{ $project->id }}/edit"><button class="button">Edit</button></a>
    </div>
    @if ($project->tasks->count())
    <div class="box">
        @foreach ($project->tasks as $task)
        
        <div>
            <form method="POST" action="/tasks/{{ $task->id }}">
                @method('PATCH')
                @csrf
                <label class="checkbox" for="completed">
                    <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                    
                    {{ $task->description }}
                </label>
            </form>
        </div>
        
        @endforeach
    </div>
    @endif
    
    <!--Add a new task form-->
    <div class="box">
    
    <form method="POST" action="/projects/{{ $project->id }}/tasks">
        @csrf
        <div class="field">
            <label class="label" for="description">New Task</label>
            
            <div class="control">
                <input type="text" class="input" name="description" placeholder="New Task" required>
            </div>
        </div>
        
        <div class="field">
            <div class="control">
                <button stype="submit" class="button is-link">Add Task</button>
            </div>
        </div>
    </form>
    </div>
    
    
    
@endsection