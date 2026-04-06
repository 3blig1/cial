<?php

namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use BelongsToSchool;

    protected $fillable = [
        'user_id',
        'file_path',
        'file_type',
        'original_name',
        'school_id',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
