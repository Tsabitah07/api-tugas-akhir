<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mentor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'grade_id',
        'birth_date',
        'age',
        'gender',
        'experience',
        'last_education',
        'last_university',
        'phone_number',
        'user_id',
        'about_me'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }
}
