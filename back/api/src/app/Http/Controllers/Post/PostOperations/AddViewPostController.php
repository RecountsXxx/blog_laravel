<?php

namespace App\Http\Controllers\Post\PostOperations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostOperations\ViewRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Post\PostOperations;
use OpenApi\Attributes as OAT;

class AddViewPostController extends Controller
{
    public function __construct(private PostOperations $featuresService){}

    #[OAT\POst(
        tags: ['operations_post'],
        path: '/api/post/add_view',
        summary: 'Add like to view',
        operationId: 'api.post.add.view',
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
                description: 'added view to post',
            ),
        ],
    )]
    public function __invoke(ViewRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->featuresService->addViewsToPost($request->post_id);
            return new BaseWithResponseResource(null, 'Added view','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
