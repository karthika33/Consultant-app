@extends('layouts.app')

@section('content')
<div class="container">
    <p>Welcome, {{ auth()->user()->name }}</p>
    <p>You can book appointments with consultants.</p>

    @if(auth()->user()->email === 'admin@example.com')
        <a href="{{ route('consultants.index') }}">View Consultants</a>
    @endif

    <a href="{{ route('appointments.create') }}" 
   style="background-color: #87CEEB; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; display: inline-block; font-size: 16px; transition: 0.3s;">
    Book an Appointment
</a>

<a href="{{ route('appointments.index') }}" 
   style="background-color: #4682B4; color: white; padding: 10px 20px; text-decoration: none; border-radius: 6px; display: inline-block; font-size: 16px; transition: 0.3s; margin-left: 10px;">
    View My Appointments
</a>

    

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="consultant_id" class="form-label">Select Consultant</label>
            <select name="consultant_id" id="consultant_id" class="form-control">
                <option value="">Choose a Consultant</option>
                @foreach($consultants as $consultant)
                    <option value="{{ $consultant->id }}">{{ $consultant->name }} - {{ $consultant->designation }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="appointment_date" class="form-label">Appointment Date & Time</label>
            <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control">
       
          </div>

        <button type="submit" class="btn btn-primary"  style="background-color: #007bff; border-color: #0056b3; padding: 12px 24px; font-size: 16px; border-radius: 6px; transition: 0.3s;">Book Appointment</button>
    </form>

    <hr>

    <h3><strong>My Appointments</strong></h3>

    @if($appointments->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Consultant</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->consultant->name }}</td>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You have no appointments yet.</p>
    @endif
</div>
@endsection