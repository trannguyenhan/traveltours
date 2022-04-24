<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOrOwnMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->hasRole(ROLE_ADMIN)){
            return $next($request);
        }

        $id = -1;
        if($request->has('id')){
            $id = $request->input('id');
        }

        if(auth()->id() != $id){
            return response()->json([
                'message' => 'No Permission'
            ], 403);
        }

        return $next($request);
    }
}
