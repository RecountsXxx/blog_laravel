<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Post\PostService;

class PostController extends Controller
{
    public function __construct(private PostService $postService){}

    public function index(): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $posts = $this->postService->index();
            return new BaseWithResponseResource([$posts], 'show posts', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    public function destroy(string $id): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->postService->destroy($id);
            return new BaseWithResponseResource(null, 'delete post', '200');
        } catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
