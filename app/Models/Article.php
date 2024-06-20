<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'article_content',
        'preview_content',
        'featured_image',
    ];

    public function Category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id', 'id');
    }
}
