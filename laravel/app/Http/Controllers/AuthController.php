<?php

namespace App\Http\Controllers;


use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    /**
     * Authentifie un utilisateur via l'API
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(LoginFormRequest $request)
    {
        // Récupère les identifiants
        $credentials = [
            'user_email' => $request->get('user_email'),
            'password'   => $request->get('user_password')
        ];

        try
        {
            if ( !$token = JWTAuth::attempt( $credentials ) )
            {
                return response()->json([
                    'status' => 'error',
                    'data'  => [
                        'message' => 'Identifiants incorrects, veuillez vérifier votre email et mot de passe.'
                    ]
                ], 400);
            }
        }
        catch ( JWTException $e )
        {
            return response()->json([
                'status' => 'error',
                'data'  => [
                    'message' => 'Une erreur est survenue lors de la génération du token.'
                ]
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'data'   => [
                'token' => $token,
                'user' => Auth::user()
            ]
        ]);
    }
}
