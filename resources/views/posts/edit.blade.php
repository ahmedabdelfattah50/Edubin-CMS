@extends('layouts.app')

@section('styleTrix')
    <link rel="stylesheet" href="{{ asset('css/trix.min.css') }}">
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
                    <button type="submit" class="btn btn-success">Update <i class="far fa-address-card"></i></button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scriptField')
    <script type="text/javascript" src="{{ asset('js/trix.min.js') }}"></script>
@endsection
