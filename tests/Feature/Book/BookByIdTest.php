<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class BookByIdTest extends TestCase
{

    private string $endpoint = 'api/v1/books';

    public function test_checks_that_the_book_has_been_returned_successfully(): void
    {
        $book = Book::factory()->create();

        $response = $this->getJson(
            "{$this->endpoint}/{$book->id}",
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(200)
            ->assertJsonFragment(
            [
                'id' => $book->id,
                'name' => $book->name,
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'language' => $book->language,
                'release_date' => $book->release_date,
                'created_at' => $book->created_at,
                'updated_at' => $book->updated_at,
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
            $this->endpoint,
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
