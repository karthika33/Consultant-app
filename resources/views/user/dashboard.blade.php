@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <p>You can book appointments with consultants.</p>

    <ul>
        <li><a href="{{ route('consultants.index') }}">View Consultants</a></li>
        <li><a href="{{ route('appointments.create') }}">Book an Appointment</a></li>
        <li><a href="{{ route('appointments.index') }}">View My Appointments</a></li>
    </ul>
</div>
@endsection
