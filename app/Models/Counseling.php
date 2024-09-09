<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id',
        'student_id',
        'counseling_date',
        'session_id',
        'expired',
        'service',
        'subject',
        'place',
        'counseling_status_id',
        'note',
    ];

    protected $casts = [
        'student_id' => 'string',
        'counseling_date' => 'datetime:Y-m-d',
        'expired' => 'boolean',
    ];

    protected $hidden = [
        'Student',
        'Mentor',
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

    public function Session()
    {
        return $this->belongsTo(CounselingSession::class, 'session_id', 'id');
    }

    public function isExpired()
    {
        $currentDateTime = Carbon::now()->addHour();
        $counselingDateTime = Carbon::parse($this->counseling_date->format('Y-m-d') . ' ' . $this->Session->end_time);

        return $currentDateTime->greaterThan($counselingDateTime);
    }
}
