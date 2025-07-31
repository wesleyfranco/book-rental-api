<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{

    private const string NAME = 'Johnny Bravo';
    private const string EMAIL = 'email@email.com';
    private const string PASSWORD = '123456';
    private const string PASSWORD_CONFIRMATION = '123456';

    private string $endpoint = 'api/v1/auth/register';

    public function test_checks_if_the_username_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'email' => self::NAME,
                'password' => self::PASSWORD,
                'password_confirmation' => self::PASSWORD_CONFIRMATION,
            ],
        );

        $response->assertStatus(422);
    }

    public function test_checks_if_the_email_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'password' => self::PASSWORD,
                'password_confirmation' => self::PASSWORD_CONFIRMATION,
            ],
        );

        $response->assertStatus(422);
    }

    public function test_checks_if_the_password_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'email' => self::EMAIL,
                'password_confirmation' => self::PASSWORD_CONFIRMATION,
            ],
        );

        $response->assertStatus(422);
    }

    public function test_checks_if_the_password_confirmation_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'email' => self::EMAIL,
                'password' => self::PASSWORD,
            ],
        );

        $response->assertStatus(422);
    }

    public function test_check_if_email_is_a_valid_email(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'email' => 'email',
                'password' => self::PASSWORD,
                'password_confirmation' => self::PASSWORD_CONFIRMATION,
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
                'name' => self::NAME,
                'email' => $user->email,
                'password' => self::PASSWORD,
                'password_confirmation' => self::PASSWORD_CONFIRMATION,
            ],
        );

        $response->assertStatus(422);
    }

    public function test_check_if_the_user_has_been_successfully_registered(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'email' => self::EMAIL,
                'password' => self::PASSWORD,
                'password_confirmation' => self::PASSWORD_CONFIRMATION,
            ],
        );

        $response->assertStatus(201);
    }
}
