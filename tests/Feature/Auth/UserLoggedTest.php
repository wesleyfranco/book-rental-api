<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class UserLoggedTest extends TestCase
{

    private string $endpoint = 'api/v1/auth/me';

    public function test_checks_if_it_fails_to_return_the_logged_in_user(): void
    {
        $token = 'abc';

        $response = $this->postJson(
            $this->endpoint,
            [],
            [
                'Authorization' => 'Bearer ' . $token,
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

    public function test_check_that_the_logged_in_user_is_returned_correctly(): void
    {
        $response = $this->postJson(
            $this->endpoint,
            [],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(200)
            ->assertExactJsonStructure(
                [
                    'success',
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'email_verified_at',
                        'created_at',
                        'updated_at',
                    ],
                ],
            );
    }
}
