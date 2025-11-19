<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Webstronauts\Unpoly\Unpoly;

class UnpolyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		if ($request->hasHeader('X-Extra-Latency')) {
			usleep(rand(7,15) / 10 * 1_000_000);
		}

		$response = $next($request);

		$up = app(Unpoly::class);
        $up->decorateResponse($request, $response);

		return $response;
    }
}
