<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;


class CspHeaders
{
    private string $cspHeader = "
        default-src 'self';
        script-src 'self' 'unsafe-inline' 'nonce-';
        style-src 'self' 'unsafe-inline' 'nonce-';
        img-src 'self' data:;
        font-src 'self';
        connect-src 'self';
        object-src 'none';
        base-uri 'self';
        frame-ancestors 'none';
    ";

    public function __construct()
    {
        $this->cspHeader = preg_replace("/\s{2,}/", "", $this->cspHeader);
    }

    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Vite::useCspNonce();

        return $next($request)->withHeaders([
            "Content-Security-Policy" => str_replace("'nonce-'", "'nonce-" . Vite::cspNonce() . "'", $this->cspHeader),
        ]);
    }
}
