<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function register(RegisterRequestInterface $request): array;
}
