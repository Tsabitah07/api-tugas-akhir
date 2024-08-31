<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Selfcare extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'slug',
        'link',
        'image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($selfcare) {
            $selfcare->slug = Str::slug($selfcare->title);
        });

        static::updating(function ($selfcare) {
            $selfcare->slug = Str::slug($selfcare->title);
        });
    }
}
