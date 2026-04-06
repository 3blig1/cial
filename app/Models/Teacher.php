<?php

namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Teacher extends Model
{
    use HasFactory, BelongsToSchool;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'specialty',
        'profile_photo_path',
        'school_id',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
