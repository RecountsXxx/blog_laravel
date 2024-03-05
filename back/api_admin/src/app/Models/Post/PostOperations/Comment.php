<?php

namespace App\Models\Post\PostOperations;

use App\Models\Post\Post;
use App\Models\Report\ReportComment;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

     protected $table = "comments";

     protected $fillable = ['comment_text','post_id','author_id'];

     public function post(){
         return $this->belongsTo(Post::class,'post_id','id');
     }
     public function author()
     {
         return $this->belongsTo(User::class,'author_id','id');
     }

    public function report()
    {
        return $this->belongsTo(ReportComment::class, 'comment_id');
    }
}
