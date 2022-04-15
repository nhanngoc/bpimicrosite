<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use App\Models\ApiKeyAccessEvent;
use Closure;
use Illuminate\Http\Request;

class AuthorizeApiKey
{
    const AUTH_HEADER = 'X-Authorization';

    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|mixed
     */
    public function handle($request, Closure $next)
    {
        $header = $request->header(self::AUTH_HEADER);
        $apiKey = ApiKey::getByKey($header);
        if ($apiKey instanceof ApiKey) {
            $this->logAccessEvent($request, $apiKey);
            return $next($request);
        }

        return response([
            'errors' => [[
                'message' => 'Unauthorized'
            ]]
        ], 401);

    }

    /**
     * Log an API key access event
     *
     * @param Request $request
     * @param ApiKey $apiKey
     */
    protected function logAccessEvent(Request $request, ApiKey $apiKey)
    {
        $event = new ApiKeyAccessEvent;
        $event->api_key_id = $apiKey->id;
        $event->ip_address = $request->ip();
        $event->url = $request->fullUrl();
        $event->save();
    }
}
