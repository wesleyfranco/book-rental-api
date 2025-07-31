<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        $response->assertStatus(401);

        $response->assertExactJsonStructure(
            [
                'success',
                'message',
            ],
        );
    }

    public function test_checks_whether_the_user_session_deletion_happened_correctly(): void
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
            ],
        );
    }
}
