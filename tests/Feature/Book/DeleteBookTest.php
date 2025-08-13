<?php

namespace Tests\Feature\Book;

use Tests\TestCase;

class DeleteBookTest extends TestCase
{

    private string $endpoint = 'api/v1/books';

    public function test_check_if_the_book_has_been_deleted_successfully(): void
    {
        $response = $this->deleteJson(
            "{$this->endpoint}/{$this->book->id}",
            [],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(204);
    }

    public function test_check_that_the_book_is_not_found(): void
    {
        $response = $this->deleteJson(
            "{$this->endpoint}/abc",
            [],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(404)
            ->assertExactJsonStructure(
                [
                    'success',
                    'message',
                ],
            );
    }

    public function test_checks_if_the_route_is_protected(): void
    {
        $token = 'abc';

        $response = $this->deleteJson(
            "{$this->endpoint}/{$this->book->id}",
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
}
