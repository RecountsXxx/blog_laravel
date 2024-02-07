<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use OpenApi\Attributes as OAT;
class PostController extends Controller
{

    public function __construct(private PostRepository $postRepository)
    {
        //$this->middleware('check.auth.jwt')->only(['store','update','destroy']);
    }

    #[OAT\Get(
        tags: ['post'],
        path: '/api/post/{$category_id}',
        summary: 'Get all posts on category',
<<<<<<< HEAD
        operationId: 'api.post.main',
=======
        operationId: 'api.post.index',
>>>>>>> 458b4afb329d8221f3ed6afa97c6146f49316ad7
        responses: [
            new OAT\Response(
                response: 200,
                description: 'retun all posts on categories',
                content: new OAT\JsonContent(ref: '#/components/schemas/PostResponse')
            ),
        ],
    )]
    public function index(Request $request)
    {
        $posts = $this->postRepository->allByCategoryId($request->category_id);

        return $posts;
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
        $post = $this->postRepository->create(['title'=>$request->title, 'text'=>$request->text,'author_id'=>$request->author_id,'category_id'=>$request->category_id]);
        return response()->json($post);
    }
    #[OAT\Get(
        tags: ['post'],
        path: '/api/post/{$id}',
        summary: 'Show post per id',
        operationId: 'api.post.show',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'id',
                        type: 'int',
                        example: '9'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return category',
                content: new OAT\JsonContent(ref: '#/components/schemas/PostResponse')
            ),
            new OAT\Response(
                response: 400,
                description: 'return error if post is not exists',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'error',
                            type: 'string',
                            example: 'not found'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function show(string $id)
    {
        $post = $this->postRepository->get(['id' => $id]);
        if($post == null){
            return response()->json(['error'=>'not found']);
        }
        return response()->json($post);
    }
    #[OAT\Put(
        tags: ['post'],
        path: '/api/post',
        summary: 'Update post per id',
        operationId: 'api.post.update',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'id',
                        type: 'int',
                        example: '9'
                    ),
                    new OAT\Property(
                        property: 'title',
                        type: 'string',
                        example: 'How to create react app'
                    ),
                    new OAT\Property(
                        property: 'text',
                        type: 'string',
                        example: 'I like codding in react'
                    ),
                    new OAT\Property(
                        property: 'author_id',
                        type: 'int',
                        example: '2'
                    ),
                    new OAT\Property(
                        property: 'category_id',
                        type: 'int',
                        example: '2'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return post',
                content: new OAT\JsonContent(ref: '#/components/schemas/PostResponse')
            ),
            new OAT\Response(
                response: 400,
                description: 'return error if post is not exists',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'error',
                            type: 'string',
                            example: 'not found'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function update(PostRequest $request, string $id)
    {
        $post = $this->postRepository->get(['id' => $id]);
        if($post == null){
            return response()->json(['error'=>'not found']);
        }
        $this->postRepository->update($post,['title'=>$request->title, 'text'=>$request->text]);
        $post = $this->postRepository->get(['id'=>$id]);
        return response()->json($post);
    }
    #[OAT\Delete(
        tags: ['post'],
        path: '/api/post/{$id}',
        summary: 'Delete post per id',
        operationId: 'api.post.destroy',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'id',
                        type: 'int',
                        example: '9'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'return message',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'string',
                            type: 'string',
                            example: 'deleted post: 9'
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: 400,
                description: 'return error if post is not exists',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'error',
                            type: 'string',
                            example: 'not found'
                        ),
                    ]
                )
            ),
        ],
    )]
    public function destroy(string $id)
    {
        $post = $this->postRepository->get(['id' => $id]);
        if($post == null){
            return response()->json(['error'=>'not found']);
        }
        $this->postRepository->delete($post);
        return response()->json(['message'=>'Deleted post: ' . $id]);
    }
}
