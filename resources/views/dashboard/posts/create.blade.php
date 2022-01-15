@extends('layouts.app')

@section('styleField')
    {{--  ##### CSS CDN for trix editor Libaray ##### --}}
    <link rel="stylesheet" href="{{ asset('css/trix.min.css') }}">
    {{--  ##### CSS CDN for select2 Libaray ##### --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Add Post
            </div>
            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input name="title" type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title" required>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="description" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description" rows="3" required></textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Content</label>
                        <input id="x" class="form-control @error('postContent') is-invalid @enderror" placeholder="Enter Content" type="hidden" name="postContent" value="{{ old('postContent') }}" required>
                        <trix-editor input="x" placeholder="Enter Content"></trix-editor>
                        @error('postContent')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" required>
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>
                        <select name="categoryID" class="form-control" id="exampleFormControlSelect1">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('categoryID')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Tags</label>
                        <select name="tags[]" class="form-control tagsSelection" id="exampleFormControlSelect1" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                    <button type="submit" class="btn btn-success">Add <i class="far fa-address-card"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptField')
    {{--  ##### JS CDN for trix editor Libaray ##### --}}
    <script type="text/javascript" src="{{ asset('js/trix.min.js') }}"></script>
    {{--  ##### JS CDN for select2 Libaray ##### --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tagsSelection').select2();
        });
    </script>
@endsection
