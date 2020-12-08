<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $message = '';
        try {
          JWTAuth::parseToken()->authenticate();
          return $next($request);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
          $message = 'token Expired';
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
          $message = 'Invalid token';
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
          $message = 'Provide token';
        }
        return response()->json([
          'success' => false,
          'message' => $message
        ]);

    }
}
