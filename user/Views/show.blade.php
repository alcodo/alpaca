@extends('app')

@section('content')
    <h1>User</h1>
    <p>{{ $user->name }}</p>
    <p>{{ $user->email }}</p>
@endsection