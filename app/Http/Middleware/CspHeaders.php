<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;


class CspHeaders
{
    private string $devHost = "http://[::1]:5173";
    private string $devWs = "ws://[::1]:5173";

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
            default-src 'self' $this->devHost;
            script-src 'self' 'unsafe-inline' 'nonce-$nonce' $this->devHost;
            style-src 'self' 'unsafe-inline' 'nonce-$nonce' $this->devHost;
            img-src 'self' data: $this->devHost;
            font-src 'self' $this->devHost;
            connect-src 'self' $this->devHost $this->devWs;
            object-src 'none';
            base-uri 'self';
            frame-ancestors 'none';
        ";

        return $next($request)->withHeaders([
            "Content-Security-Policy" => preg_replace("/\s{2,}/", " ", $cspHeader),
        ]);
    }
}
