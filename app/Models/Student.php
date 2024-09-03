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
        'year_of_entry',
        'password',
        'image',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        'remember_token'
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

        static::creating(function ($student) {
            $student->id = self::generateUniqueId();
        });
    }

    public static function generateUniqueId()
    {
        return 'ST-'.date('YmdHis').'-'.rand(1000, 9999);
    }

    public function routeNotificationFor($notification)
    {
        return $this->email;
    }
}
