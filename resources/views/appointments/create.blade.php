@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="background-color: #87CEEB; border-color: #5aa7c6; color: #fff; padding: 12px 24px; font-size: 16px; border-radius: 6px; transition: 0.3s;">Book an Appointment</h2>

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

        <div class="mb-3">
            <label for="notes" class="form-label">Notes (Optional)</label>
            <textarea name="notes" id="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="background-color: #87CEEB; border-color: #5aa7c6; color: #fff; padding: 12px 24px; font-size: 16px; border-radius: 6px; transition: 0.3s;">Book Appointment</button>
    </form>
</div>
@endsection
