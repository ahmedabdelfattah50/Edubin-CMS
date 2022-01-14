@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $post->title }} Post</div>
            <div class="card-body">
                <form action="{{ route('posts.update',$post->id) }}" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input value="{{ $post->title }}" name="title" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea style="white-space: normal" name="description" class="form-control" readonly rows="3">
                           {{ $post->description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Content</label>
{{--                        <textarea id="contentTextarea" style="white-space: normal" name="postContent" class="form-control" readonly rows="8">--}}
{{--                            {!! $post->content !!}--}}
{{--                            {!! $post->content !!}--}}
{{--                        </textarea>--}}
{{--                        <div>--}}
                            <div style="white-space: normal" name="postContent" class="form-control" readonly>{!! $post->content !!}</div>
{{--                        </div>--}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <div class="mb-4">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" title="{{ $post->title }}" height="300px" width="100%" style="border-radius: 10px">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scriptField')
    <script>
        document.getElementById('contentTextarea').innerHTML = {{ $post->content }};
    </script>
@endsection
