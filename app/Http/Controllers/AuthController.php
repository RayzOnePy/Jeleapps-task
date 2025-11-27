<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function registration(RegistrationRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'email' => $request->validated('email'),
                'password' => Hash::make($request->validated('password')),
                'gender' => $request->validated('gender'),
            ]);

            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'data' => [
                    'user' => UserResource::make($user),
                    'access_token' =>$token,
                ],
            ], 201);
        } catch (Exception $e) {
            Log::error("Не удалось зарегистрировать пользователя с почтой: {$request->validated('email')}. Ошибка: {$e->getMessage()}");
            return response()->json([
                'error' => app()->environment() === 'production' ? 'Internal server error' : $e->getMessage(),
            ], 500);
        }
    }

    public function profile(): UserResource
    {
        return UserResource::make(auth()->user());
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->validated('email'))->first();

        if (!$user || !Hash::check($request->validated('password'), $user->password)) {
            return response()->json([
                'message' => 'Не правильный логин или пароль',
            ], 422);
        }

        $user->tokens()->delete();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'data' => [
                'user' => UserResource::make($user),
                'access_token' => $token,
            ],
        ], 200);
    }
}
