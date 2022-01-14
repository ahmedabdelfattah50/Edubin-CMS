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
            <div class="card-header">Edit Post</div>
            <div class="card-body">
                <form action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input value="{{ $post->title }}" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description" rows="3">{{ trim($post->description) }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Content</label>
                        <input id="x" name="content" class="form-control @error('content') is-invalid @enderror" value="{{ $post->content }}" type="hidden">
                        <trix-editor input="x"></trix-editor>
{{--                        <textarea name="postContent" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Content" rows="8">{{ $post->content }}</textarea>--}}
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}" height="300px" width="100%" style="border-radius: 10px">
                        </div>
                        <input name="image" type="file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Category</label>
                        <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach($categories as $category)
                                @if($category->id == $post->category_id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Tags</label>
                        <select name="tags[]" class="form-control tagsSelection" id="exampleFormControlSelect1" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                @if($post->hasTag($tag->id))
                                    selected
                                @endif
                                >{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Update <i class="far fa-address-card"></i></button>
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
