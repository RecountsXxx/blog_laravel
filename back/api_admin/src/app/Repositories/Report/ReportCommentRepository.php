<?php

namespace App\Repositories\Report;

use App\Models\Report\ReportComment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ReportCommentRepository extends BaseRepository
{
    public function __construct(private ReportComment $comment)
    {
        parent::__construct($this->comment);
    }
    public function count()
    {
        return DB::table('report_comments')->count();
    }

    public function report_and_comment()
    {
        $comment = $this->comment->with(['comment' => function ($query) {
            $query->select('id', 'comment_text','author_id');
        }])->get(['id', 'comment_id', 'who_report_id', 'created_at']);

        return $comment;
    }
}
