<?php

namespace App\Interfaces;

use App\Interfaces\LoginRequestInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\RegisterRequestInterface;

interface AuthServiceInterface
{
    public function register(RegisterRequestInterface $request, AuthRepositoryInterface $authRepository): array;

    public function login(LoginRequestInterface $request): array;

    public function me(): array;

    public function logout(): void;

    public function refresh(): array;
}
