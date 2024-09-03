<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'description'
    ];

    protected $hidden = [
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($galery) {
            $galery->id = self::generateUniqueId();
        });
    }

    public static function generateUniqueId()
    {
        return 'GI-' . date('YmdHis') . rand(1000, 9999);
    }
}
