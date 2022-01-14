@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Messages <span class="badge badge-warning">{{ $messages->count() }}</span></div>
                    @if( $messages->count() == 0)
                        <h4 class="alert alert-danger m-0" style="border:0; border-radius: 0"><i class="fa fa-exclamation-triangle"></i> OOPS, no messages founded</h4>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Objects</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter = 1 ?>
                            @foreach($messages as $message)
                                <tr>
                                    <th>
                                        {{ $counter }}
                                    </th>
                                    <td><h4>{{ $message->name }}</h4></td>
                                    <td><h4>{{ $message->email }}</h4></td>
                                    <td><h4><span class="badge badge-warning">{{ $message->subject }}</span></h4></td>
                                    <td>
                                        <div class="btnsOptions pt-2">
                                                <a href="{{ route('contactUs.showMessage', $message->id) }}" class="btn btn-success">View <i class="far fa-eye"></i></a>
                                            <a href="{{ route('contactUs.deleteMessage', $message->id) }}" class="btn btn-danger">Delete <i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $counter++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
