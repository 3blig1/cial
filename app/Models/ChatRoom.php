<?php

namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ChatRoom extends Model
{
    use BelongsToSchool;

    protected $fillable = [
        'name',
        'type',
        'user_id',
        'school_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('last_read_message_id')
            ->withTimestamps();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function unreadCountForUser($userId)
    {
        $pivot = $this->users()->where('user_id', $userId)->first()?->pivot;
        $lastReadId = $pivot?->last_read_message_id;
        if ($lastReadId) {
            return $this->messages()->where('id', '>', $lastReadId)->where('user_id', '!=', $userId)->count();
        } else {
            return $this->messages()->where('user_id', '!=', $userId)->count();
        }
    }
}
