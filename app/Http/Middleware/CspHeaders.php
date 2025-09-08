<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;


class CspHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Vite::useCspNonce();

        $nonce = Vite::cspNonce();

        $cspHeader = "
            default-src 'self';
            script-src 'self' 'unsafe-inline' 'nonce-$nonce';
            style-src 'self' 'unsafe-inline' 'nonce-$nonce';
            img-src 'self' data:;
            font-src 'self';
            connect-src 'self';
            object-src 'none';
            base-uri 'self';
            frame-ancestors 'none';
        ";

        return $next($request)->withHeaders([
            "Content-Security-Policy" => preg_replace("/\s{2,}/", " ", $cspHeader),
        ]);
    }
}
