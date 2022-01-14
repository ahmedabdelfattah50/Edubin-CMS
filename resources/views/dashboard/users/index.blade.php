@extends('layouts.app')

@section('content')
    <div class="container">
{{--        <div class="btnsOptions d-flex justify-content-end mb-3">--}}
{{--            <a href="{{ route('users.create') }}" class="btn btn-success mr-1 ml-1">Add User</a>--}}
{{--        </div>--}}
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                All Users <span class="badge badge-primary">{{ $users->count() }}</span>
                            </div>
                            <div>
                                Admins <span class="badge badge-danger">{{ $totalAdminsCount }}</span>
                            </div>
                            <div>
                                Writers <span class="badge badge-danger">{{ $totalWritersCount }}</span>
                            </div>
                        </div>
                    </div>
                    @if( $users->count() == 0)
                        <h4 class="alert alert-danger m-0" style="border:0; border-radius: 0">Sorry, no posts found</h4>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role</th>
{{--                                <th scope="col">Tags</th>--}}
{{--                                <th scope="col">Options</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1 ?>
                        @foreach($users as $user)
                            <tr class="">
                                <th>
                                    <img src="{{ asset('storage/' . $user->getAvatar()) }}" alt="{{ $user->name }}" title="{{ $user->name }}" height="70px" width="70px" style="border-radius: 10px">
{{--                                    <span>Avatar</span>--}}
                                </th>
                                <td><h5>{{ $user->name }}</h5></td>
                                <td>
                                    @if(! $user->isAdmin())
                                        <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Make Admin</button>
                                        </form>
                                    @else
{{--                                        <form action="{{ route('users.make-writer', $user->id) }}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            <button type="submit" class="btn btn-success">Make Writer</button>--}}
{{--                                        </form>--}}
                                        <h5>Admin</h5>
                                    @endif
                                </td>
{{--                                <td><h4><span class="badge badge-warning">{{ $post->tags->count() }}</span></h4></td>--}}
{{--                                <td>--}}
{{--                                    <div class="btnsOptions pt-2">--}}
{{--                                        @guest--}}
{{--                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">View <i class="far fa-eye"></i></a>--}}
{{--                                        @else--}}
{{--                                            @if(!$post->trashed())--}}
{{--                                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">View <i class="far fa-eye"></i></a>--}}
{{--                                            @endif--}}
{{--                                            @if(!$post->trashed())--}}
{{--                                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>--}}
{{--                                            @else--}}
{{--                                                <a href="{{ route('trashedPosts.restore', $post->id) }}" class="btn btn-primary">Restore <i class="far fa-window-restore"></i></a>--}}
{{--                                            @endif--}}
{{--                                            <form action="{{ route('posts.destroy', $post->id) }}" class="d-inline-block" method="POST">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}
{{--                                                <input type="submit" class="btn btn-danger" value="{{ $post->trashed() ? 'Delete' : 'Trash'}}">--}}
{{--                                            </form>--}}
{{--                                        @endguest--}}
{{--                                    </div>--}}
{{--                                </td>--}}
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
