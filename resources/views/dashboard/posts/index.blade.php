@extends('layouts.app')

@section('content')
    <div class="container">
        @if(!isset($trashedPosts))
        <div class="btnsOptions d-flex justify-content-end mb-3">
            <a href="{{ route('posts.create') }}" class="btn btn-success mr-1 ml-1">Add Post</a>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @if(isset($myTrashedPosts))
                            My Trashed Posts
                        @elseif(isset($myPosts))
                            My Posts
                        @else
                            All Posts
                        @endif
{{--                        {{ isset($myPosts) ? "My Posts" : "All Posts" }} --}}
                        <span class="badge badge-warning">{{ $posts->count() }}</span></div>
                    @if( $posts->count() == 0)
                        <h4 class="alert alert-danger m-0" style="border:0; border-radius: 0"><i class="fa fa-exclamation-triangle"></i> OOPS, no posts founded</h4>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
{{--                                <th scope="col">date</th>--}}
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
{{--                                <td><h4><span class="badge badge-warning">{{ $post->created_at->format('d/m/Y') }}</span></h4></td>--}}
                                <td>
                                    <div class="btnsOptions pt-2">
                                        @guest
                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">View <i class="far fa-eye"></i></a>
                                        @else
                                            @if(!$post->trashed())
                                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">View <i class="far fa-eye"></i></a>
                                            @else
                                                <a href="{{ route('trashedPosts.showTrashedPost', $post->id) }}" class="btn btn-success">View <i class="far fa-eye"></i></a>
                                            @endif

                                            {{-- ##### this to show edit and trash buttons only for writers who owns this post ##### --}}
                                            @if(auth()->user()->id == $post->user_id || auth()->user()->isAdmin())
                                                @if(!$post->trashed())
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                                                @elseif($post->trashed() && auth()->user()->isAdmin())
                                                    <a href="{{ route('trashedPosts.restore', $post->id) }}" class="btn btn-primary">Restoere <i class="far fa-window-restore"></i></a>
                                                @else
{{--                                                    {{ $post->trashed()->title }}--}}
                                                    @if($post->trashed() && $post->request_restore == "yes")
                                                        <a href="{{ route('chancelRequestToRestoreTrashedPosts.chancelRequestToRestorePost', $post->id) }}" class="btn btn-danger">Chancel Request <i class="fas fa-times"></i></a>
                                                    @else
                                                        <a href="{{ route('requestToRestoreTrashedPosts.requestToRestorePost', $post->id) }}" class="btn btn-primary">Request to restore <i class="far fa-window-restore"></i></a>
                                                    @endif
                                                @endif
                                                @if($post->trashed() && auth()->user()->isAdmin())
                                                    <form action="{{ route('posts.destroy', $post->id) }}" class="d-inline-block" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger" value="Delete">
                                                    </form>
                                                @elseif(!($post->trashed()) && !(auth()->user()->isAdmin()))
                                                    <form action="{{ route('posts.destroy', $post->id) }}" class="d-inline-block" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger" value="Trash">
                                                    </form>
                                                @elseif(!($post->trashed()) && auth()->user()->isAdmin())
                                                    <form action="{{ route('posts.destroy', $post->id) }}" class="d-inline-block" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger" value="Trash">
                                                    </form>
                                                @endif
                                            @endif
                                        @endguest
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
