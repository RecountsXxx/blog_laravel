<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\UserNotDefinedException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthJWT
{
    public function handle(Request $request, Closure $next): Response
    {
                try{
                    $user = JWTAuth::parseToken()->authenticate();
                }
                catch (\Exception $e) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
        return $next($request);
    }
}
