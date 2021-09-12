@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit Tag</div>
            <div class="card-body">
                <form action="{{ route('tags.update',$tag->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tag Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $tag->name }}">
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection
