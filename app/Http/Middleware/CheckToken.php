<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class CheckToken
{

    public function handle(Request $request, Closure $next)
    {
        $token = $request->route('token') ?? $request->session()->get('token');

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken) {
            return redirect()->route('welcome');
        }

        return $next($request);
    }
}
