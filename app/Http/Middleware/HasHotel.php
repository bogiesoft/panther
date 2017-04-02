<?php

namespace App\Http\Middleware;

use Request;
use Closure;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Input;

class HasHotel
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
        $hotel_id = Input::get('hotel_id');

        if(is_null($hotel_id))
        {
            // hotel_id parameter not valid
            return new JsonResponse([
                'error' => [
                    'message' => "Missing URI Parameter: hotel_id",
                    'status_code' => IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY]],
                IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        
        $user_hotel_ids = JWTAuth::parseToken()->authenticate()
            ->hotels
            ->pluck('id')
            ->all();
        
        if(!in_array($hotel_id, $user_hotel_ids))
        {
            // Hotel does not belong to user
            return new JsonResponse([
                'error' => [
                    'message' => "Unauthorized access to requested hotel",
                    'status_code' => IlluminateResponse::HTTP_UNAUTHORIZED]],
                IlluminateResponse::HTTP_UNAUTHORIZED
            );
        }

        return $next($request);
    }
}
