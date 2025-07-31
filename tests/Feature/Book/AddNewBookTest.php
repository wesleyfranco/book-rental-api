<?php

namespace Tests\Feature\Book;

use App\Models\Book;
use Tests\TestCase;

class AddNewBookTest extends TestCase
{

    private const string NAME = 'Por uma história-mundo';
    private const string SYNOPSIS = 'Na era da mundialização, como escrever uma história aberta sobre o mundo...';
    private const string PUBLISHER = 'Autêntica';
    private const string EDITION = '1';
    private const int PAGE_NUMBER = 200;
    private const string ISBN = '9788582176122';
    private const string LANGUAGE = 'Português';
    private const string RELEASE_DATE = '25/07/2015';

    private string $endpoint = 'api/v1/books';

    public function test_checks_if_the_name_is_required(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
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
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
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
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
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
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
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
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
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
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
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
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'release_date' => self::RELEASE_DATE
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
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['release_date']);
    }

    public function test_check_if_book_name_is_already_registered(): void
    {
        $book = Book::factory()->create();

        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => $book->name,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(422)
            ->assertOnlyJsonValidationErrors(['name']);
    }

    public function test_check_if_the_book_has_been_successfully_registered(): void
    {
        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
            ],
            [
                'Authorization' => 'Bearer ' . $this->token,
            ],
        );

        $response->assertStatus(201)
            ->assertJsonFragment(
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
            ],
        );
    }

    public function test_checks_if_the_route_is_protected(): void
    {
        $token = 'abc';

        $response = $this->postJson(
            $this->endpoint, 
            [
                'name' => self::NAME,
                'synopsis' => self::SYNOPSIS,
                'publisher' => self::PUBLISHER,
                'edition' => self::EDITION,
                'page_number' => self::PAGE_NUMBER,
                'isbn' => self::ISBN,
                'language' => self::LANGUAGE,
                'release_date' => self::RELEASE_DATE
            ],
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
