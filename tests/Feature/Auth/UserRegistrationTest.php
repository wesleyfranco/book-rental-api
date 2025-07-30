<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{

    private string $endpoint = 'api/v1/auth/register';

    public function test_checks_if_the_username_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => 'email@email.com',
                'password' => '123456',
                'password_confirmation' => '123456',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_checks_if_the_email_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => 'Johnny Bravo',
                'password' => '123456',
                'password_confirmation' => '123456',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_checks_if_the_password_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => 'Johnny Bravo',
                'email' => 'email@email.com',
                'password_confirmation' => '123456',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_checks_if_the_password_confirmation_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => 'Johnny Bravo',
                'email' => 'email@email.com',
                'password' => '123456',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_check_if_email_is_a_valid_email(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => 'Johnny Bravo',
                'email' => 'email',
                'password' => '123456',
                'password_confirmation' => '123456',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_check_if_email_is_already_registered(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => 'Johnny Bravo',
                'email' => $user->email,
                'password' => '123456',
                'password_confirmation' => '123456',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_check_if_the_user_has_been_successfully_registered(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => 'Johnny Bravo',
                'email' => 'email@email.com',
                'password' => '123456',
                'password_confirmation' => '123456',
            ],
        );

        $response->assertStatus(201);
    }
}
