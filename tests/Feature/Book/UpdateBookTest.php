<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class UpdateBookTest extends TestCase
{

    private string $endpoint = 'api/v1/books';

    public function test_checks_if_the_name_is_required(): void
    {
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'language' => $book->language,
                'release_date' => $book->release_date,
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'name' => $book->name,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'language' => $book->language,
                'release_date' => $book->release_date,
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'name' => $book->name,
                'synopsis' => $book->synopsis,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'language' => $book->language,
                'release_date' => $book->release_date,
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'name' => $book->name,
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'language' => $book->language,
                'release_date' => $book->release_date,
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'name' => $book->name,
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'isbn' => $book->isbn,
                'language' => $book->language,
                'release_date' => $book->release_date,
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'name' => $book->name,
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'language' => $book->language,
                'release_date' => $book->release_date,
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'name' => $book->name,
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'release_date' => $book->release_date,
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'name' => $book->name,
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'language' => $book->language,
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
            [
                'name' => $book->name,
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'language' => $book->language,
                'release_date' => $book->release_date,
            ],
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
        $book = Book::factory()->create();

        $response = $this->putJson(
            "{$this->endpoint}/abc",
            [
                'name' => 'PHP Moderno',
                'synopsis' => $book->synopsis,
                'publisher' => $book->publisher,
                'edition' => $book->edition,
                'page_number' => $book->page_number,
                'isbn' => $book->isbn,
                'language' => $book->language,
                'release_date' => $book->release_date,
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
        $book = Book::factory()->create();

        $token = 'abc';

        $response = $this->putJson(
            "{$this->endpoint}/{$book->id}",
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
