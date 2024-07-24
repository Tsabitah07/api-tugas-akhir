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
        'text_one',
        'text_two',
        'text_three',
        'text_four',
        'text_five',
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
