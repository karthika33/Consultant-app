@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Users List</h2>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} - {{ $user->email }}</li>
        @endforeach
    </ul>
</div>
@endsection
