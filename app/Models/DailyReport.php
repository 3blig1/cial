<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyReport extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'report_date',
        'title',
        'content',
    ];

    protected $casts = [
        'report_date' => 'date',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
