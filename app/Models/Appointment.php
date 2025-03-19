<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Consultant;

class Appointment extends Model
{
    use HasFactory; // Uncommented for factory support

    protected $fillable = [
        'user_id', 'consultant_id', 'appointment_date', 'status', 'admin_note'
    ];

    // Relationship: An appointment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: An appointment belongs to a consultant
    public function consultant()
    {
        return $this->belongsTo(Consultant::class);
    }
}
