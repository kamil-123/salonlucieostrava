<?php

namespace App\Http\Middleware;

use Closure;

class StylistMiddleware
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
        if ($request->user() && $request->user()->stylist == null)
        {
            // return new Response(view('unauthorized')->with('role', 'STYLIST'));
            return 'You are not stylist ';
        }
        return $next($request);
    }
}
