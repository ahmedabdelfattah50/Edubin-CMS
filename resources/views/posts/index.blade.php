@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="btnsOptions d-flex justify-content-end mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-success mr-1 ml-1">Add Post</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Posts <span class="badge badge-warning">{{ $posts->count() }}</span></div>
                    @if( $posts->count() == 0)
                        <h3 class="alert alert-danger m-0">Sorry, no posts found</h3>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1 ?>
                        @foreach($posts as $post)
                            <tr>
                                <th>
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}" height="100px" width="200px" style="border-radius: 10px">
                                </th>
                                <td><h4>{{ $post->title }}</h4></td>
                                <td>
                                    <div class="btnsOptions pt-2">
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">View <i class="far fa-eye"></i></a>
                                        @if(!$post->trashed())
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                                        @endif
                                        <form action="{{ route('posts.destroy', $post->id) }}" class="d-inline-block" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger" value="{{ $post->trashed() ? 'Delete' : 'Trash'}}">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
