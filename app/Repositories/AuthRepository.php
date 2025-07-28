<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\RegisterRequestInterface;

class AuthRepository implements AuthRepositoryInterface
{

    public function __construct(private readonly User $user)
    {
    }

    public function register(RegisterRequestInterface $request): array
    {
        $this->user->name = $request->validated('name');
        $this->user->email = $request->validated('email');
        $this->user->password = bcrypt($request->validated('password'));
        $this->user->save();
  
        return $this->user->toArray();
    }
}
