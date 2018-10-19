@extends('layout')

@section('title', 'Projects Page')

@section('content')
    <h1>Projects</h1>
    
    <ul>
        @foreach($projects as $project)
        
            <li><h3>{{ $project->title }}</h3></li>
            
            <p>{{ $project->description }}</p>
        
        @endforeach
        
    </ul>
@endsection