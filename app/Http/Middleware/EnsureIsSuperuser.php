<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\HttpResponseStatus;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * A subsystem that generates response with a 404 (Not Found) status code
 * if the authenticated user is not a superuser.
 */
class EnsureIsSuperuser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @throws HttpException if the user is not a superuser
     */
    public function handle(Request $request, Closure $next): Response
    {
        assert(Auth::check(), 'User must be authenticated');
        if (Auth::user()->isSuperuser())
            return $next($request);
        abort(HttpResponseStatus::NotFound->value);
    }
}
