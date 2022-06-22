<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'slug', 'category_id', 'user_id'];

    public function category() {
        $category = Category::find($this->category_id);
        return $this->belongsTo(Category::class);
    }
}
