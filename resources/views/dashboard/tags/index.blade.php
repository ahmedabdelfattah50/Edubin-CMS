@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="btnsOptions d-flex justify-content-end mb-3">
            <a href="{{ route('tags.create') }}" class="btn btn-success mr-1 ml-1">Add Tag</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Tags <span class="badge badge-warning">{{ \App\Tag::count() }}</span></div>
                    @if( \App\Tag::count() == 0)
                        <h4 class="alert alert-danger m-0" style="border:0; border-radius: 0">Sorry, no tags found</h4>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter = 1 ?>
                            @foreach($tags as $tag)
                                <tr>
                                    <td><h4>{{ $tag->name }} <span class="badge badge-warning">{{ $tag->posts->count() }}</span></h4></td>
                                    <td>
                                        <div class="btnsOptions pt-2">
                                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>
                                            <form action="{{ route('tags.destroy', $tag->id) }}" class="d-inline-block" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Delete">
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
