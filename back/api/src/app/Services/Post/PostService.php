<?php

namespace App\Services\Post;

use App\Repositories\Post\PostRepository;

class PostService
{
    public function __construct(private PostRepository $postRepository){}

    public function store($request)
    {
        $this->postRepository->create(['title'=>$request->title, 'text'=>$request->text,'author_id'=>$request->author_id,'category_id'=>$request->category_id]);
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

    public function GetPostsOnCategory($id){
        return  $this->postRepository->allByCategoryId($id);
    }

    public  function  GetPostsOnUser($id)
    {
       return $this->postRepository->allByUserId($id);
    }
}
