<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultant; // Import Consultant Model
use App\Models\Appointment; // Import Appointment Model
use App\Models\User; // Import User Model

class AdminController extends Controller
{
    // Show all consultants
    public function consultants()
    {
        $consultants = Consultant::all();
        return view('admin.consultants', compact('consultants'));
    }

    // Show all appointments
    public function appointments()
    {
        $appointments = Appointment::all();
        $consultants = Consultant::all();
        return view('admin.appointments', compact('appointments','consultants'));
    }

    // Update Appointment Status
    public function updateAppointment(Request $request)
    {
        $appointment = Appointment::find($request->id);

        if (!$appointment) {
            return redirect()->back()->with('error', 'Appointment not found');
        }

        $appointment->status = $request->status; // Update status
        $appointment->save();  // Save changes

        return redirect()->back()->with('success', 'Appointment updated successfully!');
    }

    // Delete a User (Admin Only)
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->delete(); // Delete the user

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
