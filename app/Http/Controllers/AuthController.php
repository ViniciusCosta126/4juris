<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = $request->user();

            $token = $user->createToken('token');
            return response()->json(['message' => "Autorizado", 'token' => $token->plainTextToken, 'user' => $user], 200);
        }
        return response()->json('Não autorizado', 401);
    }
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete(); // Revoga todos os tokens do usuário

        return response()->json(['message' => 'Logout bem-sucedido']);
    }
}
