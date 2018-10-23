@extends('layout')

@section('title', 'Projects Page')

@section('content')
    <h1 class="title">Create new project</h1>
    
<form method="POST" action="/projects">
    {{ csrf_field() }}
    <div class="field">
                    <div class="control">
        <input type="text" name="title" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" placeholder="Project Title" value="{{ old('title') }}" required>
        </div>
    </div>
    <div class="field">
                    <div class="control">
        <textarea name="description" class="textarea {{ $errors->has('description') ? 'is-danger' : '' }}" placeholder="Project Description" required>{{ old('description') }}</textarea>
        </div>
    </div>
    <div class="field">
        <button type="submit" class="button is-link">Create Project</button>
    </div>
</form>
<a href="/projects"><button class="button">Return</button></a>



@endsection