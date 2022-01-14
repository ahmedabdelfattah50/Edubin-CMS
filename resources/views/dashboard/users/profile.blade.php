@extends('layouts.app')

@section('styleField')
    {{--  ##### CSS CDN for trix editor Libaray ##### --}}
    <link rel="stylesheet" href="{{ asset('css/trix.min.css') }}">
    {{--  ##### CSS CDN for select2 Libaray ##### --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit Profile</div>
            <div class="card-body">
                <form action="{{ route('users.profileUpdate',$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input value="{{ $user->name }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input value="{{ $user->email }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">About</label>
                        <textarea name="about" class="form-control @error('about') is-invalid @enderror" placeholder="please, enter some data about you" rows="3">{{ $profile->about }}</textarea>
                        @error('about')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">LinkedIn</label>
                        <input value="{{ $profile->linkedin }}" name="linkedin" type="text" class="form-control @error('linkedin') is-invalid @enderror">
                        @error('linkedin')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">FaceBook</label>
                        <input value="{{ $profile->facebook }}" name="facebook" type="text" class="form-control @error('facebook') is-invalid @enderror">
                        @error('facebook')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Twitter</label>
                        <input value="{{ $profile->twitter }}" name="twitter" type="text" class="form-control @error('twitter') is-invalid @enderror">
                        @error('twitter')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Instagram</label>
                        <input value="{{ $profile->instagram }}" name="instagram" type="text" class="form-control @error('instagram') is-invalid @enderror">
                        @error('instagram')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Picture</label>
                        <br>
                        <img src="{{ asset('storage/' . $user->getAvatar()) }}" width="100px" height="100px" alt="">
                        <input name="avatar" type="file" class="mt-2 form-control @error('avatar') is-invalid @enderror">
                        @error('avatar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Update Profile <i class="far fa-address-card"></i></button>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scriptField')
    {{--  ##### JS CDN for trix editor Libaray ##### --}}
    <script type="text/javascript" src="{{ asset('js/trix.min.js') }}"></script>
    {{--  ##### JS CDN for select2 Libaray ##### --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tagsSelection').select2();
        });
    </script>
@endsection
