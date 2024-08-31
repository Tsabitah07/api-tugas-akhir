<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'writer',
        'category_id',
        'article_content',
        'preview_content',
        'link',
        'featured_image',
    ];

    public function Category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id', 'id');
    }
}
