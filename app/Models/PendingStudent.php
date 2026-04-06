<?php

namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingStudent extends Model
{
    use HasFactory, BelongsToSchool;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'profile_photo_path',
        'language_level',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'emergency_contact_email',
        'school_id',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
