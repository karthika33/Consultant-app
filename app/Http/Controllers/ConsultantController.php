<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultant;

class ConsultantController extends Controller
{
    // Show all consultants
    public function index()
    {
        $consultants = Consultant::all();
        return view('admin.consultants', compact('consultants'));
    }

    // Show form to add consultant (Only accessible by admin@example.com)
    public function create()
    {
        if (auth()->user()->email !== 'admin@example.com') {
            return redirect()->route('consultants.index')->with('error', 'Unauthorized Access!');
        }

        return view('consultants.create');
    }

    // Store a new consultant (Only accessible by admin@example.com)
    public function store(Request $request)
    {
        if (auth()->user()->email !== 'admin@example.com') {
            return redirect()->route('consultants.index')->with('error', 'Unauthorized Access!');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:consultants,email',
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:255',
        ]);

        Consultant::create($request->all());

        return redirect()->route('consultants.index')->with('success', 'Consultant created successfully.');
    }

    // Delete a consultant (Only accessible by admin@example.com)
    public function destroy(Consultant $consultant)
    {
        if (auth()->user()->email !== 'admin@example.com') {
            return redirect()->route('consultants.index')->with('error', 'Unauthorized Access!');
        }

        $consultant->delete();
        return redirect()->route('admin.consultants')->with('success', 'Consultant deleted successfully!');
    }
}
