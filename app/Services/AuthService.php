<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\LoginRequestInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\RegisterRequestInterface;

class AuthService implements AuthServiceInterface
{

    public function register(RegisterRequestInterface $request, AuthRepositoryInterface $authRepository): array 
    {
        $user = $authRepository->register($request);

        return $user;
    }

    public function login(LoginRequestInterface $request): array
    {
        $email = $request->validated('email');
        $password = $request->validated('password');

        $credentials = \compact('email', 'password');

        $token = Auth::attempt($credentials);
  
        if (!$token) {
            return [];
        }
  
        return $this->respondWithToken($token);
    }

    public function me(): array
    {
        $user = Auth::user();

        return $user->toArray();
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function refresh(): array
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }
}
