<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AvatarUploadRequest;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Account\AvatarService;
use OpenApi\Attributes as OAT;

class AvatarUploadController extends Controller
{
    public function __construct(private AvatarService $avatarService){}
    #[OAT\Post(
        tags: ['account'],
        path: '/api/account/avatar-upload',
        summary: 'Update user avatar (auth Bearer)',
        operationId: 'api.account.avatar.upload',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "upload avatar ",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'user_id',
                        type: 'int',
                        example: '22'
                    ),
                    new OAT\Property(
                        property: 'avatar',
                        type: 'file',
                        example: 'image content'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'avatar his updated',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Admin is updated'
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: 422,
                description: 'not found user',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'message',
                            type: 'string',
                            example: 'user not found'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function __invoke(AvatarUploadRequest $request): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->avatarService->uploadAvatarFromContent($request->user_id,$request->file('avatar'));

            return new BaseWithResponseResource(null,'Avatar is updated','200');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
