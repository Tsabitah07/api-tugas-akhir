<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Mentor extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'username',
        'email',
        'role_id',
        'grade_id',
        'birth_place',
        'birth_date',
        'age',
        'gender',
        'experience',
        'last_education',
        'last_university',
        'phone_number',
        'about_me',
        'linkedin',
        'instagram',
        'twitter',
        'facebook',
        'image',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

//    public function user(): BelongsTo
//    {
//        return $this->belongsTo(User::class, 'user_id', 'id');
//    }

    public function Grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }
}
