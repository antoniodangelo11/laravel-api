@extends('admin.layouts.base')

@section('contents')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Last Update</th>
                <th scope="col">Collaborators</th>
                <th scope="col">Description</th>
                <th scope="col">Technologies</th>
                <th scope="col">Type</th>
                <th scope="col">Link</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $project->title }}</th>
                <td>{{ $project->author }}</td>
                <td>{{ $project->creation_date}}</td>
                <td>{{ $project->last_update }}</td>
                <td>{{ $project->collaborators }}</td>
                <td>{{ $project->description }}</td>
                <td>
                    @foreach ($project->technologies as $technology)
                        <a href="{{route('admin.technology.show', ['technology' => $technology])}}">{{$technology->name}}</a>
                    @endforeach
                </td>
                <td><a href="{{ route('admin.type.show', ['type' => $project->type]) }}">{{ $project->type->name }}</a></td>
                <td><a href="{{ $project->link_github }}">Link</a></td>
            </tr>
        </tbody>
    </table>
    <div class="container">
        <img class="w-100" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
    </div>
@endsection