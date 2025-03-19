<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Consultant;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Show appointments based on user role
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $appointments = Appointment::with('user', 'consultant')->get(); // Admin sees all
        } else {
            $appointments = Appointment::where('user_id', Auth::id())->get(); // User sees their own appointments
        }

        return view('appointments.index', compact('appointments'));
    }

    // Show appointment booking form
    public function create()
    {
        $consultants = Consultant::all();
        return view('appointments.create', compact('consultants'));
    }

    // Store new appointment request
    public function store(Request $request)
    {
        $request->validate([
            'consultant_id' => 'required|exists:consultants,id',
            'appointment_date' => 'required|date|after:today',
            'notes' => 'nullable|string'
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'consultant_id' => $request->consultant_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pending',
            'notes' => $request->notes
        ]);

        return redirect()->route('appointments.index')->with('success', 'Appointment requested successfully!');
    }

    // ✅ Approve an appointment
    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'approved';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment approved successfully.');
    }

    // ❌ Reject an appointment
    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'rejected';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment rejected successfully.');
    }

    // ✅ Update Appointment Status (Admin Only)
    public function updateStatus(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized Access');
        }

        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status; // Accepts "approved", "rejected", or "pending"
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }
}
