<?php

namespace App\Services\Auth;

use App\Http\Resources\Auth\SuccessLoginResource;
use Illuminate\Support\Facades\Auth;

class JwtService
{

    public function guardApi(array $data)
    {
        $token = Auth::guard('api')->attempt($data);
        return $token;
    }
    public function userLogout(): void
    {
        Auth::guard('api')->logout();
    }
    public function buildResponse(string|null $token)
    {
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        return new SuccessLoginResource(
            [
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
                ]
            ]
        );
    }
}
