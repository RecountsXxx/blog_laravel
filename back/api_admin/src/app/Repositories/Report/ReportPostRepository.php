<?php

namespace App\Repositories\Report;

use App\Models\Report\ReportPost;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ReportPostRepository extends BaseRepository
{
    //сделать под репозиторий
    public function __construct(private ReportPost $post)
    {
        parent::__construct($this->post);
    }

    public function count()
    {
        return DB::table('report_posts')->count();
    }

    public function report_and_post()
    {
        $post = $this->post->with(['post' => function ($query) {
            $query->select('id', 'author_id');
        }])->get(['id', 'post_id', 'who_report_id', 'created_at']);

        return $post;
    }
}
