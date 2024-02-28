<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\JwtService;
use OpenApi\Attributes as OAT;


class LoginController extends Controller
{
    public function __construct(
        private JwtService $jwtService,
    )
    {
    }
    #[OAT\Post(
        tags: ['auth admin'],
        path: '/api/auth/login',
        summary: 'Login a user',
        operationId: 'api.auth.login',
        requestBody: new OAT\RequestBody(
            required: true,
            content: new OAT\JsonContent(ref: '#/components/schemas/LoginRequest')
        ),
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Ok',
                content: new OAT\JsonContent(ref: '#/components/schemas/SuccessLoginResource')
            ),
            new OAT\Response(
                response: 422,
                description: 'invalid password',
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
                            example: 'Unauthorized'
                        ),
                    ]
                )
            ),
            ]
    )]
    public function __invoke(LoginRequest $request)
    {
        $token = $this->jwtService->guardApi([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return $this->jwtService->buildResponse($token);
    }
}
