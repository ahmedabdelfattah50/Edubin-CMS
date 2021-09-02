@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="btnsOptions d-flex justify-content-end mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-success mr-1 ml-1">Add Post</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Posts <span class="badge badge-warning">{{ \App\Post::count() }}</span></div>
                    <div class="card-body">
                        @if( \App\Post::count() == 0)
                            <h3 class="alert alert-danger m-0">Sorry, no posts found</h3>
                        @else
                        <?php $counter = 1 ?>
                            @foreach($posts as $post)
                            <div class="jumbotron jumbotron-fluid mb-2" style="border-radius: 10px; padding: 20px 5px">
                                <div class="container">
                                    <h3>{{ $counter++ }} - {{ $post->title }}</h3>
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}" height="300px" width="100%" style="border-radius: 10px">
    {{--                                <p class="mb-0" style="font-size: 18px">{{ $post->description }}</p>--}}
                                    <div class="btnsOptions pt-2">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">View <i class="far fa-eye"></i></a>
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" class="d-inline-block" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="Delete">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
