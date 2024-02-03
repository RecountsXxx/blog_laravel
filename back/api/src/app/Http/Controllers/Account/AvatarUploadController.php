<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AvatarUploadRequest;
use App\Repositories\UserRepository;
use App\Services\Account\AvatarService;
use OpenApi\Attributes as OAT;
class AvatarUploadController extends Controller
{
    public function __construct(
        private UserRepository $userRepository,
        private AvatarService $avatarService
    )
    {
    }

    #[OAT\Post(
        tags: ['account'],
        path: '/api/account/avatar_upload',
        summary: 'Update user avatar',
        operationId: 'api.account.avatar-upload',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "upload avatar ",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'id',
                        type: 'int',
                        example: '101'
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
                            property: 'status',
                            type: 'string',
                            example: 'true'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function __invoke(AvatarUploadRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->avatarService->uploadAvatarFromContent($request->id,$request->file('avatar'));

        return response()->json(['status' => 'true']);
    }
}
