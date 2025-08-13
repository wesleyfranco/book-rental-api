<?php

namespace Tests\Feature\Book;

use Tests\TestCase;

class BookByIdTest extends TestCase
{

    private string $endpoint = 'api/v1/books';

    public function test_checks_that_the_book_has_been_returned_successfully(): void
    {
        $response = $this->getJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(200)
            ->assertJsonFragment(
                [
                    'id' => $this->book->id,
                    'name' => $this->book->name,
                    'synopsis' => $this->book->synopsis,
                    'publisher' => $this->book->publisher,
                    'edition' => $this->book->edition,
                    'page_number' => $this->book->page_number,
                    'isbn' => $this->book->isbn,
                    'language' => $this->book->language,
                    'release_date' => $this->book->release_date,
                    'created_at' => $this->book->created_at,
                    'updated_at' => $this->book->updated_at,
                ],
            );
    }

    public function test_check_that_the_book_is_not_found(): void
    {
        $response = $this->getJson(
            "{$this->endpoint}/abc",
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

        $response = $this->getJson(
            "{$this->endpoint}/{$this->book->id}",
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
