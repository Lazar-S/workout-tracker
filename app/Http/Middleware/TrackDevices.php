<?php

namespace App\Http\Middleware;

use App\Models\TrackDevice;
use Closure;
use Illuminate\Http\Client\ConnectionException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;

class TrackDevices
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws ConnectionException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ipAddress = $request->ip();
        $isPrivate = !filter_var(
            $ipAddress,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );
        $ip = $isPrivate ? "" : $ipAddress;
        if($isPrivate){
            $device = TrackDevice::find(1);
            $response = [
                'ip' => $device->ip,
                'country' => $device->country,
                'city' => $device->city,
                'flag' => ['emoji' => $device->flag]
            ];
        }
        else{
            $url = "https://ipwho.is/$ip?fields=ip,country,city,flag.emoji";
            $response = Http::withoutVerifying()->get($url)->json();
        }

        $agent = new Agent();
        $tracked = [
            'device_type' => $agent->deviceType(),
            'platform' => $agent->platform(),
            'browser' => $agent->browser(),
            'ip' => $response['ip'],
            'country' => $response['country'],
            'city' => $response['city'],
            'flag' => $response['flag']['emoji']
        ];

        TrackDevice::create($tracked);

        return $next($request);
    }
}
