@extends('layout')

@section('title', 'Projects Page')

@section('content')
    <h1>Create new project</h1>
    
<form method="POST" action="/projects">
    {{ csrf_field() }}
    <div>
        <input type="text" name="title" placeholder="Project Title">
    </div>
    <div>
        <textarea name="description" placeholder="Project Description"></textarea>
    </div>
    <div>
        <button type="submit">Create Project</button>
    </div>
</form>
@endsection