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

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function Grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function Role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($mentor) {
            $mentor->id = Mentor::generateUniqueId();
        });
    }

    public static function generateUniqueId()
    {
        return 'MT-'.date('YmdHis').rand(100, 999);
    }
}
