@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="btnsOptions d-flex justify-content-end mb-3">
            <a href="{{ route('categories.create') }}" class="btn btn-success mr-1 ml-1">Add Category</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Categories <span class="badge badge-warning">{{ \App\Category::count() }}</span></div>
                    <div class="card-body">
                        @if( \App\Category::count() == 0)
                            <h3 class="alert alert-danger m-0">Sorry, no categories found</h3>
                        @else
                        <?php $counter = 1 ?>
                            @foreach($categories as $category)
                            <div class="jumbotron jumbotron-fluid mb-2" style="border-radius: 10px; padding: 20px 5px">
                                <div class="container">
                                    <h3>{{ $counter++ }} - {{ $category->name }}</h3>
    {{--                                <p class="mb-0">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>--}}
                                    <div class="btnsOptions pt-2">
    {{--                                    <a href="#df" class="btn btn-primary">View</a>--}}
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit <i class="far fa-edit"></i></a>

                                        <form action="{{ route('categories.destroy', $category->id) }}" class="d-inline-block" method="POST">
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
