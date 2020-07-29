<?php

namespace App\Http\Middleware;

use App\Http\Responses\JsonResponse;
use App\ObjectFactory;
use App\Services\JwtService;
use Closure;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        $jwtService = ObjectFactory::getJwtService();
        $success = $jwtService->validate($token);

        if (!$success) {
            return JsonResponse::error($jwtService->getErrors(), 401);
        }

        return $next($request);
    }
}
