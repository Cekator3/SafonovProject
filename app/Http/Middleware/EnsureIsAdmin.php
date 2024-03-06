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
 * if the authenticated user is not an admin.
 */
class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @throws HttpException if the user is not a admin
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->isAdmin())
            return $next($request);
        assert(Auth::check(), 'User must be authenticated');
        abort(HttpResponseStatus::NotFound->value);
    }
}
