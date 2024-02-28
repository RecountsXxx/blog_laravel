<?php

namespace App\Services\Report;

use App\Repositories\Report\ReportCommentRepository;
use App\Repositories\Report\ReportPostRepository;

class ReportService
{

    public function __construct(private ReportCommentRepository $commentRepository, private ReportPostRepository $postRepository)
    {

    }

    public function reportComment($data)
    {
        $this->commentRepository->create($data);
    }

    public function reportPost($data)
    {
        $this->postRepository->create($data);
    }
}
