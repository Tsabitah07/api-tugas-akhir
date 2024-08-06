<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'nis',
        'email',
        'username',
        'name',
        'role_id',
        'grade_id',
        'phone_number',
        'birth_place',
        'birth_date',
        'password',
        'image',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'remember_token'
    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

//    public function user(): BelongsTo
//    {
//        return $this->belongsTo(User::class, 'user_id', 'id');
//    }
}
