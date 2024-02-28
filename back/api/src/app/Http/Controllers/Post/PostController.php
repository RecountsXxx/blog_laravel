<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostOnCategoryRequest;
use App\Http\Requests\Post\PostOnUserRequest;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Post\PostService;
use OpenApi\Attributes as OAT;

class PostController extends Controller
{

    public function __construct(private PostService $postService)
    {
        $this->middleware('check.auth.jwt')->only(['store','update','destroy']);
    }



    #[OAT\Post(
        tags: ['post'],
        path: '/api/post',
        summary: 'Add post',
        operationId: 'api.post.store',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(ref: '#/components/schemas/PostRequest')
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return new created post',
                content: new OAT\JsonContent(ref: '#/components/schemas/PostResponse')
            ),
        ],
    )]
    public function store(PostRequest $request)
    {
        try {
            $this->postService->store($request);
            return new BaseWithResponseResource(null, 'add post','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    #[OAT\Get(
        tags: ['post'],
        path: '/api/post/{$id}',
        summary: 'Show post per id',
        operationId: 'api.post.show',
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return post',
                content: new OAT\JsonContent(ref: '#/components/schemas/PostResponse')
            ),
        ],
    )]
    public function show(string $id)
    {
        try {
           $post =  $this->postService->show($id);
            return new BaseWithResponseResource(['post'=>$post], 'show post','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    #[OAT\Delete(
        tags: ['post'],
        path: '/api/post/{$id}',
        summary: 'Delete post per id',
        operationId: 'api.post.destroy',
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return message',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'message',
                            type: 'string',
                            example: 'deleted post: 9'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function destroy(string $id)
    {
        try {
            $this->postService->destroy($id);

            return new BaseWithResponseResource(null, 'delete post','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    #[OAT\Post(
        tags: ['post'],
        path: '/api/post/category',
        summary: 'Get all posts on category',
        operationId: 'api.post.get_on_category',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "get posts ",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'category_id',
                        type: 'int',
                        example: '22'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'retun all posts on categories',
                content: new OAT\JsonContent(ref: '#/components/schemas/PostResponse')
            ),
        ],
    )]
    public function GetPostsOnCategory(PostOnCategoryRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $posts = $this->postService->GetPostsOnCategory($request->category_id);

            return new BaseWithResponseResource(['posts'=> $posts], 'Get posts on category','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
    #[OAT\Post(
        tags: ['post'],
        path: '/api/post/user',
        summary: 'Get all posts on author',
        operationId: 'api.post.get_on_user',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "get posts  ",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'user_id',
                        type: 'int',
                        example: '22'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'retun all posts on author',
                content: new OAT\JsonContent(ref: '#/components/schemas/PostResponse')
            ),
        ],
    )]
    public function GetPostsOnUser(PostOnUserRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $posts = $this->postService->GetPostsOnUser($request->user_id);

            return new BaseWithResponseResource(['posts'=> $posts], 'Get posts on user','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }

}
