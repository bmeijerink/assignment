@extends('layout')

@section('content')
    <div class="row">
        Encrypted message: {{$message->encrypted_message ?? ''}}
    </div>
    <div class="row">
        Password: {{$password ?? ''}}
    </div>
    <div class="row">
        Url to use: {{$url ?? ''}}
    </div>
@endsection
