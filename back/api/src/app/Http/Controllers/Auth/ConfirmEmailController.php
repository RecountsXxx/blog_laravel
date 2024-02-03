<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

class ConfirmEmailController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }
    #[OAT\Head(
        tags: ['auth'],
        path: '/api/auth/confirm_email/{id}/{token}',
        summary: 'Confirm a email',
        operationId: 'api.auth.confirm_email',
        requestBody: new OAT\RequestBody(
            required: true,
            description: "Token for email confirmation",
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'id',
                        type: 'string',
                        example: '101'
                    ),
                    new OAT\Property(
                        property: 'token',
                        type: 'string',
                        example: 'bb93c30a-9cac-4827-924b-1be4dfe1ceb8'
                    ),
                ]
            )
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'email confirmed',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'status',
                            type: 'string',
                            example: 'Redirect to /'
                        ),
                    ]
                )
            ),
        ]
    )]
    public function __invoke($id, $token)
    {
        $user = $this->userRepository->get(['id'=>$id, 'confirmation_token'=>$token], true);
        if($user->email_verified == true){
            return redirect('/');
        }
        $this->userRepository->update($user,['email_verified'=>true]);

        return redirect('/');
    }
}
