<?php

namespace App\Repositories\Report;

use App\Models\Report\ReportComment;
use App\Repositories\BaseRepository;

class ReportCommentRepository extends BaseRepository
{
    //сделать под репозиторий
    public function __construct(private ReportComment $comment)
    {
        parent::__construct($this->comment);
    }
}
