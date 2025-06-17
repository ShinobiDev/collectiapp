<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomJwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Verificar si hay un token y es válido
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Debe iniciar sesión para acceder a esta área.',
                ], 401);
            }
        } catch (\Exception $e) {
            // Token inválido, expirado, etc.
            return response()->json([
                'success' => false,
                'message' => 'Token no válido o expirado, inicie sesión nuevamente.',
            ], 401);
        }

        return $next($request);
    }
}
