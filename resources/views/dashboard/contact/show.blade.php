@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label>Name</label>
                        <input value="{{ $message->name }}" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{ $message->email }}" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input value="{{ $message->phone }}" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input value="{{ $message->subject }}" type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <p class="form-control" readonly>{{ $message->message }}</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
