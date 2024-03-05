<?php

namespace App\Models\Report;

use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPost extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','who_report_id'];

    protected $table= 'report_posts';

    public function reporter()
    {
        return $this->belongsTo(User::class, 'who_report_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
