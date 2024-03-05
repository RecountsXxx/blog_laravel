<?php

namespace App\Repositories\Post\PostOperations;

use App\Models\Post\PostOperations\Comment;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository
{
    //сделать под репозиторий
    public function __construct(private Comment $comment)
    {
        parent::__construct($this->comment);
    }
}
