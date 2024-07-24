<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade_id',
        'student_id',
        'counseling_date',
        'time',
        'service',
        'subject',
        'place',
        'counseling_status_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(CounselingStatus::class, 'counseling_status_id', 'id');
    }
}
