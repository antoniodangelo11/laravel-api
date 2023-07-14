@extends('admin.layouts.base')

@section('contents')

    <h1>Add Project</h1>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.project.store') }}" novalidate>
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                class="form-control @error('title') is-invalid @enderror"
                id="title"
                name="title"
                value="{{ old('title') }}"
            >
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="creation_date" class="form-label">Creation Date</label>
            <input
                type="date"
                class="form-control @error('creation_date') is-invalid @enderror"
                id="creation_date"
                name="creation_date"
                value="{{ old('creation_date') }}"
            >
            @error('creation_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="last_update" class="form-label">Last Update</label>
            <input
                type="date"
                class="form-control @error('last_update') is-invalid @enderror"
                id="last_update"
                name="last_update"
                value="{{ old('last_update') }}"
            >
            @error('last_update')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input
                type="text"
                class="form-control @error('author') is-invalid @enderror"
                id="author"
                name="author"
                value="{{ old('author') }}"
            >
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="collaborators" class="form-label">Collaborators</label>
            <input
                type="text"
                class="form-control @error('collaborators') is-invalid @enderror"
                id="collaborators"
                name="collaborators"
                value="{{ old('collaborators') }}"
            >
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                rows="10"
                name="description">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            <label class="input-group-text" for="image">Upload</label>
            <div class="invalid-feedback">
                @error('image') {{ $message }} @enderror
            </div>
        </div>
        
        <div class="mb-3">
            <h3>Technologies</h3>
            @foreach($technologies as $technology)
                <div class="mb-3 form-check">
                    <input
                        type="checkbox"
                        class="form-check-input"
                        id="technology{{ $technology->id }}"
                        name="technologies[]"
                        value="{{ $technology->id }}"
                        @if (in_array($technology->id, old('technologies') ?: [])) checked @endif
                    >
                    <label class="form-check-label" for="technology{{ $technology->id }}">{{ $technology->name }}</label>

                </div>
            @endforeach

            {{-- @dump($errors->get('tags.*')) --}}
            {{-- @error('tags')
                <div class="">
                    {{ $message }}
                </div>
            @enderror --}}
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select @error('type_id') is-invalid @enderror" id="type" name="type_id">
                <option selected>Change type</option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                @error('type_id') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="link_github" class="form-label">Link Github</label>
            <input
                type="url"
                class="form-control @error('link_github') is-invalid @enderror"
                id="link_github"
                name="link_github"
                value="{{ old('link_github') }}"
            >
            @error('link_github')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Create</button>
    </form>

@endsection