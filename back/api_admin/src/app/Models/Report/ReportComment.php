<?php

namespace App\Models\Report;

use App\Models\Post\PostOperations\Comment;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportComment extends Model
{
    use HasFactory;
    protected $fillable = ['comment_id','who_report_id'];

    protected $table= 'report_comments';

    public function reporter()
    {
        return $this->belongsTo(User::class, 'who_report_id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class,'id');
    }
}
