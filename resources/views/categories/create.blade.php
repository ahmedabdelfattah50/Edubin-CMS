@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">

            <div class="card-header">
            {{-- ######### this is if I used the same form of create to be update form ######### --}}
{{--                {{ isset($category) ? "Update Category" : "Add Category" }}--}}
                Add Category
            </div>
            <div class="card-body">

                {{-- ######### this is a second way to display error messages ######### --}}
                {{-- @if( $errors->any() )
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Name">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
