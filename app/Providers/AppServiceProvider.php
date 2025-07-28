<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepository;
use App\Repositories\BookRepository;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\RepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\AuthServiceInterface;
use App\Interfaces\BookRequestInterface;
use App\Interfaces\BookServiceInterface;
use App\Interfaces\LoginRequestInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\RegisterRequestInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookServiceInterface::class, BookService::class);

        $this->app->bind(BookRequestInterface::class, BookRequest::class);

        $this->app->bind(RepositoryInterface::class, BookRepository::class);

        $this->app->bind(AuthServiceInterface::class, AuthService::class);

        $this->app->bind(RegisterRequestInterface::class, RegisterRequest::class);

        $this->app->bind(LoginRequestInterface::class, LoginRequest::class);

        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
