<?php

namespace App\Http\Controllers\Post\PostOperations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostOperations\CommentRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Post\PostOperations;
use OpenApi\Attributes as OAT;

class AddCommentPostController extends Controller
{
    public function __construct(private PostOperations $featuresService){}

    #[OAT\Post(
        tags: ['operations_post'],
        path: '/api/post/add_comment',
        summary: 'Add comment to post',
        operationId: 'api.post.add.comment',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(ref: '#/components/schemas/CommentRequest')
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'comment added',
            ),
        ],
    )]
    public function __invoke(CommentRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $comment = ['post_id'=>$request->post_id,'author_id'=>$request->author_id,'comment_text'=>$request->comment_text];
            $this->featuresService->addCommentToPost($comment);
            return new BaseWithResponseResource(null, 'Added comment','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
