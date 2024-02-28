<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepository;

class PostService
{
    public function __construct(private PostRepository $postRepository){}

    public function index()
    {
        return $this->postRepository->all();
    }
    public  function show($id)
    {
        return $this->postRepository->post_and_author_and_comments($id);
    }
    public function destroy($id)
    {
        $post = $this->postRepository->get(['id' => $id]);
        $this->postRepository->delete($post);
    }
}
