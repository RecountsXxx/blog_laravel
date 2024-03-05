<?php

namespace App\Repositories\Report;

use App\Models\Report\ReportPost;
use App\Repositories\BaseRepository;

class ReportPostRepository extends BaseRepository
{
    //сделать под репозиторий
    public function __construct(private ReportPost $comment)
    {
        parent::__construct($this->comment);
    }
}
