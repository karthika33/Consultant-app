@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Appointments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Consultant</th>
                <th>Appointment Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $appointment->consultant->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>
                        <span class="badge bg-{{ $appointment->status == 'approved' ? 'success' : ($appointment->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </td>
                    <td>
                        @if(auth()->user()->role == 'admin' && $appointment->status == 'pending')
                            <form action="{{ route('appointments.approve', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('appointments.reject', $appointment->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
