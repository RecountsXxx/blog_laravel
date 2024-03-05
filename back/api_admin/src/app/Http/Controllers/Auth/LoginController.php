<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\JwtService;

class LoginController extends Controller
{
    public function __construct(private JwtService $jwtService,){}
    public function __invoke(LoginRequest $request)
    {
        $token = $this->jwtService->guardApi([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return $this->jwtService->buildResponse($token);
    }
}
