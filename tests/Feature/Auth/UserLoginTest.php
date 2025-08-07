<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class UserLoginTest extends TestCase
{

    private const string EMAIL = 'email@email.com';
    private const string PASSWORD = '123456';

    private string $endpoint = 'api/v1/auth/login';

    public function test_checks_if_the_email_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'password' => self::PASSWORD,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['email']);
    }

    public function test_checks_if_the_password_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => self::EMAIL,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['password']);
    }

    public function test_check_if_email_is_a_valid_email(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => 'email',
                'password' => self::PASSWORD,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['email']);
    }

    public function test_checks_if_login_failed_by_sending_a_non_existent_username(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => self::EMAIL,
                'password' => self::PASSWORD,
            ],
        );

        $response->assertStatus(401)
            ->assertExactJsonStructure(
            [
                'success',
                'message',
            ],
        );
    }

    public function test_checks_if_the_login_was_successful(): void
    {
        $user = User::factory()->create(
            [
                'password' => self::PASSWORD,
            ],
        );

        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => $user->email,
                'password' => self::PASSWORD,
            ],
        );

        $response->assertStatus(200)
            ->assertExactJsonStructure(
            [
                'success',
                'data' => [
                    'access_token',
                    'token_type',
                    'expires_in',
                ],
            ],
        );
    }
}
