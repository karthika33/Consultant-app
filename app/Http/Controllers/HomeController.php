<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultant;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all consultants
        $consultants = Consultant::all();

        // Fetch appointments for the logged-in user
        $appointments = Appointment::where('user_id', Auth::id())->get();

        // Return the dashboard view with consultants and appointments
        return view('dashboard', compact('consultants', 'appointments'));
    }
} 