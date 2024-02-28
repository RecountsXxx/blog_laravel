<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Auth\JwtService;
use OpenApi\Attributes as OAT;

class LogoutController extends Controller
{
    public function __construct(
        private readonly JwtService  $jwtService,
    ){}
    #[OAT\Get(
        path: '/api/auth/logout',
        operationId: 'api.auth.logout',
        summary: 'Perform logout for user',
        requestBody: new OAT\RequestBody(
            required: false
        ),
        tags: ['auth'],
        responses: [
            new OAT\Response(
                response: 200,
                description: 'Admin successfully logged out',
                content: new OAT\JsonContent(
                    properties: [
                        new OAT\Property(
                            property: 'status',
                            type: 'string',
                            example: 'success'
                        ),
                        new OAT\Property(
                            property: 'message',
                            type: 'string',
                            example: 'Admin successfully logged out'
                        ),
                    ]
                )
            ),
            new OAT\Response(
                response: 500,
                description: 'Some internal server error occurred',
                content: new OAT\JsonContent(ref: '#/components/schemas/InternalServerErrorResource')
            )]
    )]
    public function __invoke(): BaseWithResponseResource|InternalServerErrorResource
    {
        try {
            $this->jwtService->userLogout();

            return new BaseWithResponseResource(null, 'Admin successfully logged out');
        }
        catch (\Exception $e) {
            return new InternalServerErrorResource(['error' => $e->getMessage()]);
        }
    }
}
