<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Psychology extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($psychology) {
            $psychology->slug = Str::slug($psychology->title);
        });

        static::updating(function ($psychology) {
            $psychology->slug = Str::slug($psychology->title);
        });
    }
}
