<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id',
        'student_id',
        'counseling_date',
        'service',
        'subject',
        'counseling_status_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(CounselingStatus::class, 'counseling_status_id', 'id');
    }
}
