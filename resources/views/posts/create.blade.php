@extends('layouts.app')

@section('styleTrix')
    <link rel="stylesheet" href="{{ asset('css/trix.min.css') }}">
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
                        <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Description" rows="3"></textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Content</label>
                        <input id="x" class="form-control @error('postContent') is-invalid @enderror" placeholder="Enter Content" type="hidden" name="postContent">
                        <trix-editor input="x" placeholder="Enter Content"></trix-editor>
{{--                        <textarea name="postContent" class="form-control @error('description') is-invalid @enderror" placeholder="Enter Content" rows="8"></textarea>--}}
                        @error('postContent')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input name="image" type="file" class="form-control @error('image') is-invalid @enderror">
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
                    <button type="submit" class="btn btn-success">Add <i class="far fa-address-card"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scriptField')
    <script type="text/javascript" src="{{ asset('js/trix.min.js') }}"></script>
@endsection
