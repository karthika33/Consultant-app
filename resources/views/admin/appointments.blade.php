@extends('layouts.app') <!-- Change this to your admin layout if different -->

@section('content')
<div class="container">
    <h2>Manage Appointments</h2>
    
    @if(session('success'))
        <div class="alert alert-success" id="flash-message">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => document.getElementById('flash-message').style.display = 'none', 3000);
        </script>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>Consultant</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ optional($appointment->user)->name ?? 'N/A' }}</td>
                    <td>{{ optional($appointment->consultant)->name ?? 'N/A' }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>
                        @if ($appointment->status == 'Pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif ($appointment->status == 'Approved')
                            <span class="badge bg-success">Approved</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        <!-- Approve/Reject Appointment Buttons -->
                        <form action="{{ route('admin.updateAppointment') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $appointment->id }}">
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                <option value="Pending" {{ strtolower($appointment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ strtolower($appointment->status) == 'approved' ? 'selected' : '' }}>Approve</option>
                                <option value="Rejected" {{ strtolower($appointment->status) == 'rejected' ? 'selected' : '' }}>Reject</option>
                            </select>
                        </form>

                        <!-- Delete User Button -->
                        <form action="{{ route('admin.deleteUser', optional($appointment->user)->id) }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this user?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete User</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
