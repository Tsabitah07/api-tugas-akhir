<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selfcare extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'tutorial',
        'text',
        'text2',
        'text3',
        'text4',
        'text5'
    ];
}
