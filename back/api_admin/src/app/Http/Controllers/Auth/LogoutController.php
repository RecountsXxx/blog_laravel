<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseWithResponseResource;
use App\Http\Resources\Errors\InternalServerErrorResource;
use App\Services\Auth\JwtService;
class LogoutController extends Controller
{
    public function __construct(private readonly JwtService  $jwtService,){}
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
