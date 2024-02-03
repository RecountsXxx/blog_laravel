<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\JwtService;
use App\Services\Auth\UserService;
use OpenApi\Attributes as OAT;

#[OAT\Post(
    tags: ['auth'],
    path: '/api/auth/register',
    summary: 'Register a user',
    operationId: 'api.auth.register',
    requestBody: new OAT\RequestBody(
        required: true,
        content: new OAT\JsonContent(ref: '#/components/schemas/RegisterRequest')
    ),
    responses: [
        new OAT\Response(
            response: 200,
            description: 'Ok',
            content: new OAT\JsonContent(ref: '#/components/schemas/SuccessLoginResource')
        ),
        new OAT\Response(
            response: 422,
            description: 'password confirmation',
            content: new OAT\JsonContent(
                properties: [
                    new OAT\Property(
                        property: 'status',
                        type: 'string',
                        example: 'error'
                    ),
                    new OAT\Property(
                        property: 'message',
                        type: 'string',
                        example: 'password confirmation.'
                    ),
                ]
            )
        ),

        ]
)]
class RegisterController extends Controller
{
    public function __construct(
        private UserService $userService,
        private JwtService $jwtService,
    )
    {
    }

    public function __invoke(RegisterRequest $request): mixed
    {
        if ($request->input('password') != $request->input('password_confirmation')){
            return response()->json([
                'status' => 'error',
                'message' => 'password confirmation',
            ], 422);
        }
        $this->userService->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        $token = $this->jwtService->guardApi([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return $this->jwtService->buildResponse($token);
    }

}
