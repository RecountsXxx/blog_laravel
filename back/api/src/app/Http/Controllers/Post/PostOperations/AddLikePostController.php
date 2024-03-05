<?php

namespace App\Http\Controllers\Post\PostOperations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostOperations\LikeRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Post\PostOperations;
use OpenApi\Attributes as OAT;

class AddLikePostController extends Controller
{

    public function __construct(private PostOperations $featuresService){}

    #[OAT\Post(
        tags: ['operations_post'],
        path: '/api/post/add_like',
        summary: 'Add like to post',
        operationId: 'api.post.add.like',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "add like ",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'post_id',
                        type: 'int',
                        example: '22'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'added like to post',
            ),
        ],
    )]
    public function __invoke(LikeRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->featuresService->addLikeToPost($request->post_id);
            return new BaseWithResponseResource(null, 'Added like','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
