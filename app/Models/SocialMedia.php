<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'linkedin',
        'instagram',
        'facebook',
        'twitter',
    ];

    protected $hidden = [
        'id',
        'unique_id',
        'created_at',
        'updated_at',
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}
