<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthenticateAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        //$allowedSecrets = explode(',', config('services.allowed.secret'));

        $allowedSecrets = [

             "80000000-8000-8000-8000-000000000008",
             "80000008-8008-8008-8008-800000000008",
             "90000000-9000-9000-9000-000000000009",
             "90000009-9009-9009-9009-900000000009",
        ];

        if (in_array($request->header('user-id'), $allowedSecrets)) {
            return $next($request);
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }

}
