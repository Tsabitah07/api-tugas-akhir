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
        'time',
        'expired',
        'service',
        'subject',
        'place',
        'counseling_status_id',
        'note',
    ];

    protected $casts = [
        'counseling_date' => 'datetime:Y-m-d',
        'expired' => 'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function Student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function Grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function Status()
    {
        return $this->belongsTo(CounselingStatus::class, 'counseling_status_id', 'id');
    }
}
