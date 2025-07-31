<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserSessionRefreshTest extends TestCase
{

    private string $endpoint = 'api/v1/auth/refresh';

    public function test_check_if_the_attempt_to_refresh_the_token_fails(): void
    {
        $token = 'abc';

        $response = $this->postJson(
            $this->endpoint, 
            [], 
            [
                'Authorization' => 'Bearer ' . $token,
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

    public function test_checks_if_the_token_was_updated_correctly(): void
    {
        $user = User::factory()->create();

        $token = Auth::fromUser($user);

        $response = $this->postJson(
            $this->endpoint, 
            [], 
            [
                'Authorization' => 'Bearer ' . $token,
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
