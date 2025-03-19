<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Ensure HomeController exists)
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes (Authenticated Users Only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🟢 Admin Panel (Consultants & Appointments)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/consultants', [AdminController::class, 'consultants'])->name('admin.consultants');
    Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
});

// 🟢 Consultant Routes (Public Viewing)
Route::get('/consultants', [ConsultantController::class, 'index'])->name('consultants.index');
Route::get('/consultants/{consultant}', [ConsultantController::class, 'show'])->name('consultants.show');

// 🔴 Consultant Management (Admin Only)
Route::middleware(['auth'])->group(function () {
    Route::get('/consultants/create', [ConsultantController::class, 'create'])->name('consultants.create');
    Route::post('/consultants', [ConsultantController::class, 'store'])->name('consultants.store');
    Route::get('/consultants/{consultant}/edit', [ConsultantController::class, 'edit'])->name('consultants.edit');
    Route::patch('/consultants/{consultant}', [ConsultantController::class, 'update'])->name('consultants.update');
    Route::delete('/consultants/{consultant}', [ConsultantController::class, 'destroy'])->name('consultants.destroy');
});

// 🟢 Appointments (Users can book, Admins can approve/reject)
Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index'); 
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create'); 
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store'); 
    Route::post('/admin/update-appointment', [AdminController::class, 'updateAppointment'])->name('admin.updateAppointment');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');


    // 🔴 Admin-only: Approve/Reject Appointments
    Route::post('/appointments/{appointment}/approve', [AppointmentController::class, 'approve'])->name('appointments.approve');
    Route::post('/appointments/{appointment}/reject', [AppointmentController::class, 'reject'])->name('appointments.reject');

    // 🔴 Admin updates appointment status
    Route::put('/admin/appointments/{id}/update', [AppointmentController::class, 'updateStatus'])->name('admin.appointment.update');
});

// Authentication Routes
require __DIR__.'/auth.php';