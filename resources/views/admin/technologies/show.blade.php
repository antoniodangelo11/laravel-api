@extends('admin.layouts.base')

@section('contents')
    
    <h1>{{ $technology->name }}</h1>
    <p>{{ $technology->description }}</p>

    <h2>Latest Project in this Technology</h2>
    <ul>
        @foreach ($technology->projects as $project)
            <li><a href="{{ route('admin.project.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
        @endforeach
    </ul>

@endsection