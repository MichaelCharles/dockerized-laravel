@extends('layout')

@section('title', 'Projects Page')

@section('content')
    <h1 class="title">Projects</h1>
    
    <ul>
        @foreach($projects as $project)
            <a href="/projects/{{ $project->id }}">
            <li>
                {{ $project->title }}
            </li>
            </a>
        @endforeach
        
        <a href="/projects/create"><button class="button is-link">Create new</button></a>
        
    </ul>
@endsection