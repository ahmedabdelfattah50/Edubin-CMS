@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="row d-flex justify-content-around">
                        <a href="{{ route('users.index') }}" class="card text-white bg-primary mb-3 col-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Users</h5>
                                <h5 class="card-title">{{ $usersCount }}</h5>
                            </div>
                        </a>
                        <a href="{{ route('categories.index') }}" class="card text-white bg-success mb-3 col-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Categories</h5>
                                <h5 class="card-title">{{ $categoriesCount }}</h5>
                            </div>
                        </a>
                        <a href="{{ route('tags.index') }}" class="card text-white bg-danger mb-3 col-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Tags</h5>
                                <h5 class="card-title">{{ $tagsCount }}</h5>
                            </div>
                        </a>

                        <a href="{{ route('posts.index') }}" class="card text-white bg-secondary mb-3 col-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Posts</h5>
                                <h5 class="card-title">{{ $postsCount }}</h5>
                            </div>
                        </a>

                        <a href="{{ route('trashedPosts.index') }}" class="card text-white bg-dark mb-3 col-5">
                            <div class="card-body text-center">
                                <h5 class="card-title">Trashed Posts</h5>
                                <h5 class="card-title">{{ $trashedPostsCount }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
