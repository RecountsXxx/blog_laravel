<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

   protected $fillable = ['title','text','category_id','author_id'];
    protected static function booted()
    {
        static::created(function ($post) {
            $post->category->updatePostCount();
        });

        static::updated(function ($post) {
            $post->category->updatePostCount();
        });

        static::deleted(function ($post) {
            $post->category->updatePostCount();
        });
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'author_id','id');
    }
}
