<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\JwtService;
use App\Services\Auth\UserService;

class RegisterController extends Controller
{
    public function __construct(private UserService $userService, private JwtService $jwtService) {}

    public function __invoke(RegisterRequest $request)
    {
        if ($this->userService->findOrFail($request->input('email')) !== null) {
            return response()->json([
                'status' => 'error',
                'message' => 'This email already taken',
            ], 401);
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
