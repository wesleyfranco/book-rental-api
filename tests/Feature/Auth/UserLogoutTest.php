<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class UserLogoutTest extends TestCase
{

    private string $endpoint = 'api/v1/auth/logout';

    public function test_checks_if_deleting_the_user_session_failed(): void
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

    public function test_checks_whether_the_user_session_deletion_happened_correctly(): void
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
                'message',
            ],
        );
    }
}
