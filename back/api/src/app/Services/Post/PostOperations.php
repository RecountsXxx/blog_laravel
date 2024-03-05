<?php

namespace App\Services\Post;

use App\Repositories\Post\PostOperations\CommentRepository;
use App\Repositories\Post\PostRepository;

class PostOperations
{

    public function __construct(private PostRepository $postRepository, private CommentRepository $commentRepository){}
    public function addLikeToPost($id){
        $post = $this->postRepository->findOrFail($id);
        $this->postRepository->update($post,['likes_count' => $post->likes_count+1]);;
    }

    public function addViewsToPost($id)
    {
        $post = $this->postRepository->findOrFail($id);
        $this->postRepository->update($post,['views_count' => $post->views_count+1]);
    }

    public function addCommentToPost($data)
    {
        $this->commentRepository->create($data);
    }
}
