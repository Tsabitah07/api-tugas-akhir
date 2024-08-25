<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'mentor_id',
        'receiver_id',
        'counseling_id',
        'title',
        'receiver',
        'subject',
        'message',
        'sender',
        'is_read'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'is_read' => 'boolean'
    ];

    protected $hidden = [
        'student_id',
        'mentor_id',
        'receiver_id',
        'counseling_id',
        'updated_at'
    ];

    public function Student()
    {
        return $this->belongsTo(Student::class. 'student_id', 'id');
    }

    public function Mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id', 'id');
    }

    public function Counseling()
    {
        return $this->belongsTo(Counseling::class, 'counseling_id', 'id');
    }
}
