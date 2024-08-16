<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        // Validar os dados recebidos
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Tentar autenticar o usuário com as credenciais fornecidas
        if (Auth::attempt($credentials)) {
            // Autenticado com sucesso
            $user = Auth::user();
            $token = $user->createToken('api-rifa')->plainTextToken; // Gera um token para o usuário

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        // Falha na autenticação
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas são inválidas.'],
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        // Revoke the user's current token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}
