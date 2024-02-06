<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends BaseRepository
{
    public function __construct(private Post $post)
    {
        parent::__construct($post);
    }
    public function allByCategoryId(int $category_id)
    {
        return $this->post->where('category_id', $category_id)->get();
    }
}
