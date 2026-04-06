<?php
namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, BelongsToSchool;
    protected $fillable = ['name', 'school_id'];
    public function exams() { return $this->hasMany(Exam::class); }
    public function school() { return $this->belongsTo(School::class); }
}
