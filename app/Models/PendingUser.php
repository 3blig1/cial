<?php
namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Model;

class PendingUser extends Model
{
    use BelongsToSchool;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'school_id',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    protected $hidden = ['password'];
}
