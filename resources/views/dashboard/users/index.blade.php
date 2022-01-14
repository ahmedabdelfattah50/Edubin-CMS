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
                            </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1 ?>
                        @foreach($users as $user)
                            <tr class="">
                                <th>
                                    <img src="{{ asset('storage/' . $user->getAvatar()) }}" alt="{{ $user->name }}" title="{{ $user->name }}" height="70px" width="70px" style="border-radius: 10px">
                                </th>
                                <td><h5>{{ $user->name }}</h5></td>
                                <td>
                                    @if(! $user->isAdmin())
                                        <form action="{{ route('users.make-admin', $user->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Make Admin</button>
                                        </form>
                                    @else
                                        <h5>Admin</h5>
                                    @endif
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
