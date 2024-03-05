<?php

namespace App\Repositories\Post;

use App\Models\Post\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    //сделать под репозиторий
    public function __construct(private Post $post)
    {
        parent::__construct($post);
    }

    public function post_and_author_and_comments(int $post_id)
    {
        $post = $this->post->with(['author', 'comments.author:id,name,avatar_url'])->find($post_id);
        return $post;
    }

    public function allByCategoryId(int $category_id)
    {
        $posts = $this->post->with('author')
            ->where('category_id', $category_id)
            ->paginate(8);
        return $posts;
    }
    public function allByUserId(int $author_id)
    {
        return $this->post->where('author_id', $author_id)->get();
    }
}
