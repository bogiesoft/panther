<?php

namespace App\Http\Middleware;

use Request;
use Closure;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;

class HasCompany
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
        $company = JWTAuth::parseToken()
            ->authenticate()
            ->company;

        if(is_null($company))
        {
            // User doesn't own a company
            return new JsonResponse([
                'error' => [
                    'message' => "Unauthorized access to requested resources",
                    'status_code' => IlluminateResponse::HTTP_UNAUTHORIZED]],
                IlluminateResponse::HTTP_UNAUTHORIZED
            );
        }

        return $next($request);
    }
}
