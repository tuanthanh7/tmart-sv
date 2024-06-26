<?php

namespace App\Http\Middleware;

use App\SERVICE;
use App\Supports\Message;
use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AdminMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     // $token = JWTAuth::getToken();
    //     // if ($token == "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIyMDAwMjg3MjAwMTEwNCIsIm5hbWUiOiJUaGFuaFRoaWVuIiwiaWF0IjoxNTE2MjM5MDIyfQ.6uoV7C4Gd3r5jzN5O8F_50hDkKo6HxtivbRgwzr6wpI") {
    //         return $next($request);
    //     // }
    //     // return response()->json([
    //     //     'message'     => "Token Store không hợp lệ",
    //     // ], 400);
    // }

    public function handle($request, Closure $next)
    {
        // $tokenStore = env('TOKEN_STORE');

        // if (!$request->bearerToken() || $request->bearerToken() !== $tokenStore) {
        //     return response()->json(['message' => 'Token không đúng'], 401);
        // }
        if (SERVICE::isAdminUser()) {
            return $next($request);
        }else{
            throw new AccessDeniedHttpException(Message::get("no_permission"));
        }
        return $next($request);
    }

}