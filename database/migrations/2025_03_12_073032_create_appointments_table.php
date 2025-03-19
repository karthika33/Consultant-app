<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who books the appointment
            $table->foreignId('consultant_id')->constrained()->onDelete('cascade'); // Consultant assigned
            $table->dateTime('appointment_date'); // Appointment Date and Time
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status of the appointment
            $table->text('notes')->nullable(); // Optional Notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
