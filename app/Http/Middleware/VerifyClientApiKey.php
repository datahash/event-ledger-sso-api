<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Organisation;
use Illuminate\Support\Facades\Session;

class VerifyClientApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        // $organisation = Organisation::find($request->header('x-api-key-id'));
        $organisation = Organisation::where('api_client_id', $request->header('x-api-id'))->first();
        $apiKey = $organisation->api_client_secret;

        $apiKeyIsValid = (
            ! empty($apiKey)
            && $request->header('x-api-secret') == $apiKey
        );

        abort_if (! $apiKeyIsValid, 403, 'Access denied');

        session()->put('organisation_id', $organisation->id);
        session()->put('account_id', $organisation->account_id);

        return $next($request);
    }
}
