@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Consultants List</h2>

    @if(auth()->user()->email === 'admin@example.com')
        <a href="{{ route('consultants.create') }}">Add Consultant</a>

        <ul>
            @foreach($consultants as $consultant)
                <li>{{ $consultant->name }} - {{ $consultant->designation }}</li>
            @endforeach
        </ul>
    @else
        <p>You are not authorized to view this page.</p>
    @endif
</div>
@endsection
