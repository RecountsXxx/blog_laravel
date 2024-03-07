<?php

namespace App\Models\Post;

use App\Models\Category\Category;
use App\Models\Post\PostOperations\Comment;
use App\Models\Report\ReportPost;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

   protected $fillable = ['title','text','category_id','author_id','likes_count','views_count'];
    protected static function booted()
    {
        static::created(function ($post) {
            $post->category->updatePostCount();
        });

        static::deleted(function ($post) {
            $post->category->updatePostCount();
        });
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function author(){
        return $this->belongsTo(User::class,'author_id','id');
    }

    public function report(){
        return $this->belongsTo(ReportPost::class,'post_id','id');
    }
}
