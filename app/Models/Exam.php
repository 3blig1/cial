<?php
namespace App\Models;

use App\Models\Concerns\BelongsToSchool;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory, BelongsToSchool;
    protected $fillable = ['title', 'description', 'exam_date', 'user_id', 'subject_id', 'school_id'];
    public function teacher() { return $this->belongsTo(User::class, 'user_id'); }
    public function grades() { return $this->hasMany(ExamGrade::class); }
    public function subject() { return $this->belongsTo(Subject::class); }
    public function school() { return $this->belongsTo(School::class); }
}
