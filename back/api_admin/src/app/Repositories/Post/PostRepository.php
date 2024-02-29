<?php

namespace App\Repositories\Post;

use App\Models\Post\Post;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

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

    public function count()
    {
        return DB::table('posts')->count();
    }
}
