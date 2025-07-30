<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class UserLoginTest extends TestCase
{

    private string $endpoint = 'api/v1/auth/login';

    public function test_checks_if_the_email_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'password' => '123456',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_checks_if_the_password_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => 'email@email.com',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_check_if_email_is_a_valid_email(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => 'email',
                'password' => '123456',
            ],
        );

        $response->assertStatus(422);
    }

    public function test_checks_if_login_failed_by_sending_a_non_existent_username(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => 'email@email.com',
                'password' => '123456',
            ],
        );

        $response->assertStatus(401);

        $response->assertExactJsonStructure(
            [
                'success',
                'message',
            ],
        );
    }

    public function test_checks_if_the_login_was_successful(): void
    {
        $password = '123456';

        $user = User::factory()->create(
            [
                'password' => $password,
            ],
        );

        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => $user->email,
                'password' => $password,
            ],
        );

        $response->assertStatus(200);

        $response->assertExactJsonStructure(
            [
                'success',
                'message',
                'data' => [
                    'access_token',
                    'token_type',
                    'expires_in',
                ],
            ],
        );
    }
}
