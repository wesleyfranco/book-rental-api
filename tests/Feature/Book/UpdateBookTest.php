<?php

namespace Tests\Feature\Book;

use Tests\TestCase;

class UpdateBookTest extends TestCase
{

    private string $endpoint = 'api/v1/books';

    public function test_checks_if_the_name_is_required(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'synopsis' => $this->book->synopsis,
                'publisher' => $this->book->publisher,
                'edition' => $this->book->edition,
                'page_number' => $this->book->page_number,
                'isbn' => $this->book->isbn,
                'language' => $this->book->language,
                'release_date' => $this->book->release_date,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['name']);
    }

    public function test_checks_if_the_synopsis_is_required(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'name' => $this->book->name,
                'publisher' => $this->book->publisher,
                'edition' => $this->book->edition,
                'page_number' => $this->book->page_number,
                'isbn' => $this->book->isbn,
                'language' => $this->book->language,
                'release_date' => $this->book->release_date,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['synopsis']);
    }

    public function test_checks_if_the_publisher_is_required(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'name' => $this->book->name,
                'synopsis' => $this->book->synopsis,
                'edition' => $this->book->edition,
                'page_number' => $this->book->page_number,
                'isbn' => $this->book->isbn,
                'language' => $this->book->language,
                'release_date' => $this->book->release_date,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['publisher']);
    }

    public function test_checks_if_the_edition_is_required(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'name' => $this->book->name,
                'synopsis' => $this->book->synopsis,
                'publisher' => $this->book->publisher,
                'page_number' => $this->book->page_number,
                'isbn' => $this->book->isbn,
                'language' => $this->book->language,
                'release_date' => $this->book->release_date,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['edition']);
    }

    public function test_checks_if_the_page_number_is_required(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'name' => $this->book->name,
                'synopsis' => $this->book->synopsis,
                'publisher' => $this->book->publisher,
                'edition' => $this->book->edition,
                'isbn' => $this->book->isbn,
                'language' => $this->book->language,
                'release_date' => $this->book->release_date,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['page_number']);
    }

    public function test_checks_if_the_isbn_is_required(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'name' => $this->book->name,
                'synopsis' => $this->book->synopsis,
                'publisher' => $this->book->publisher,
                'edition' => $this->book->edition,
                'page_number' => $this->book->page_number,
                'language' => $this->book->language,
                'release_date' => $this->book->release_date,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['isbn']);
    }

    public function test_checks_if_the_language_is_required(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'name' => $this->book->name,
                'synopsis' => $this->book->synopsis,
                'publisher' => $this->book->publisher,
                'edition' => $this->book->edition,
                'page_number' => $this->book->page_number,
                'isbn' => $this->book->isbn,
                'release_date' => $this->book->release_date,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['language']);
    }

    public function test_checks_if_the_release_date_is_required(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'name' => $this->book->name,
                'synopsis' => $this->book->synopsis,
                'publisher' => $this->book->publisher,
                'edition' => $this->book->edition,
                'page_number' => $this->book->page_number,
                'isbn' => $this->book->isbn,
                'language' => $this->book->language,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['release_date']);
    }

    public function test_check_that_the_book_has_been_successfully_updated(): void
    {
        $response = $this->putJson(
            "{$this->endpoint}/{$this->book->id}",
            [
                'name' => $this->book->name,
                'synopsis' => $this->book->synopsis,
                'publisher' => $this->book->publisher,
                'edition' => $this->book->edition,
                'page_number' => $this->book->page_number,
                'isbn' => $this->book->isbn,
                'language' => $this->book->language,
                'release_date' => $this->book->release_date,
            ],
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
        $response = $this->putJson(
            "{$this->endpoint}/abc",
            [
                'name' => 'PHP Moderno',
                'synopsis' => $this->book->synopsis,
                'publisher' => $this->book->publisher,
                'edition' => $this->book->edition,
                'page_number' => $this->book->page_number,
                'isbn' => $this->book->isbn,
                'language' => $this->book->language,
                'release_date' => $this->book->release_date,
            ],
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

        $response = $this->putJson(
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
