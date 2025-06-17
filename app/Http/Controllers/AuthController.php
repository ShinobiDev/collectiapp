<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar datos de entrada
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            // Intentar obtener un token con las credenciales
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Credenciales inválidas'
                ], 401);
            }

            // Si todo bien, devolver token y datos del usuario
            $user = Auth::user();

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::logout();
            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cerrar sesión: ' . $e->getMessage()
            ], 500);
        }
    }
}
