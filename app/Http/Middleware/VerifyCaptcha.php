<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VerifyCaptcha
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $secret   = config('limosa.captcha_key');
        $response = Http::get(
            "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" .
            $request->get('g-recaptcha-response') . "&remoteip=" . $_SERVER['REMOTE_ADDR']
        );

        if (!$response->ok()) {
            return new JsonResponse('{"message": "Failure"}', 422);
        }

        $score = $response->collect()->get('score');

        if ($score < 0.4) {
            return response()->json('{"message": "Failure"}');
        }

        return $next($request);
    }
}
