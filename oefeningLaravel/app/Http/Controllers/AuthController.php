<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/register",
     *     tags={"Auth"},
     *     summary="Register",
     *     description="Register",
     *     operationId="register",
     *     @OA\Response(
     *     response=201,
     *     description="Success: Register",
     *     ),
     *     @OA\RequestBody(
     *     description="Register",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/User"),
     *     ),
     *     )
     * )
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'user_role_id' => 2
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * @OA\Post(
     *     path="/login",
     *     tags={"Auth"},
     *     summary="Login",
     *     description="Login",
     *     operationId="login",
     *     @OA\Response(
     *     response=201,
     *     description="Success: Login",
     *     ),
     *     @OA\RequestBody(
     *     description="Login",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/User"),
     *     ),
     *     )
     */

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * @OA\Post(
     *     path="/logout",
     *     tags={"Auth"},
     *     summary="Logout",
     *     description="Logout",
     *     operationId="logout",
     *     @OA\Response(
     *     response=201,
     *     description="Success: Logout",
     *     ),
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *     description="Logout",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/User"),
     *     ),
     *     )
     * )
     *
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
