<?php

namespace Tests;

use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected string $token;
    protected Book $book;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->token = Auth::fromUser($user);

        $this->book = Book::factory()->create();
    } 
}
