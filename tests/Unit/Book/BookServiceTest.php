<?php

namespace Tests\Unit\Book;

use Mockery;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Support\Str;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
use App\Repositories\BookRepository;
use App\Interfaces\RepositoryInterface;
use App\Interfaces\BookServiceInterface;

class BookServiceTest extends TestCase
{
    private RepositoryInterface $bookRepository;
    private BookServiceInterface $bookService;

    public function setUp(): void
    {
        parent::setUp();

        $this->bookRepository = new BookRepository(new Book);
        $this->bookService = new BookService($this->bookRepository);
    }

    public function test_check_that_there_are_no_registered_books(): void
    {
        $this->bookService->destroy($this->book->id);

        $allBooks = $this->bookService->all();

        $this->assertCount(0, $allBooks['data']);
    }

    public function test_check_if_you_have_successfully_registered_the_book(): void
    {
        $mockRequest = Mockery::mock(BookRequest::class);

        $mockRequest->shouldReceive('validated')
            ->andReturn([
                'name' => fake()->sentence(5),
                'synopsis' => fake()->text(),
                'publisher' => Str::random(10),
                'edition' => (string) fake()->randomDigit(),
                'page_number' => fake()->randomNumber(3),
                'isbn' => fake()->isbn13(),
                'language' => Str::random(10),
                'release_date' => fake()->date(),
        ]);

        $book = $this->bookService->store($mockRequest);

        $this->assertArrayHasKey('name', $book);
        $this->assertArrayHasKey('synopsis', $book);
        $this->assertArrayHasKey('publisher', $book);
        $this->assertArrayHasKey('edition', $book);
        $this->assertArrayHasKey('page_number', $book);
        $this->assertArrayHasKey('isbn', $book);
        $this->assertArrayHasKey('language', $book);
        $this->assertArrayHasKey('release_date', $book);
    }

    public function test_check_if_you_found_the_book_by_id(): void
    {
        $book = $this->bookService->show($this->book->id);

        $this->assertArrayHasKey('name', $book);
        $this->assertArrayHasKey('synopsis', $book);
        $this->assertArrayHasKey('publisher', $book);
        $this->assertArrayHasKey('edition', $book);
        $this->assertArrayHasKey('page_number', $book);
        $this->assertArrayHasKey('isbn', $book);
        $this->assertArrayHasKey('language', $book);
        $this->assertArrayHasKey('release_date', $book);
    }

    public function test_check_if_not_found_the_book_by_id(): void
    {
        $book = $this->bookService->show('abc');

        $this->assertCount(0, $book);
    }

    public function test_check_if_you_have_successfully_update_the_book(): void
    {
        $name = fake()->sentence(5);
        $synopsis = fake()->text();
        $publisher = Str::random(10);
        $edition = (string) fake()->randomDigit();
        $pageNumber = fake()->randomNumber(3);
        $isbn = fake()->isbn13();
        $language = Str::random(10);
        $releaseDate = fake()->date();

        $mockRequest = Mockery::mock(BookRequest::class);

        $mockRequest->shouldReceive('validated')
            ->andReturn([
                'name' => $name,
                'synopsis' => $synopsis,
                'publisher' => $publisher,
                'edition' => $edition,
                'page_number' => $pageNumber,
                'isbn' => $isbn,
                'language' => $language,
                'release_date' => $releaseDate,
        ]);

        $book = $this->bookService->update($mockRequest, $this->book->id);

        $this->assertEquals($name, $book['name']);
        $this->assertEquals($synopsis, $book['synopsis']);
        $this->assertEquals($publisher, $book['publisher']);
        $this->assertEquals($edition, $book['edition']);
        $this->assertEquals($pageNumber, $book['page_number']);
        $this->assertEquals($isbn, $book['isbn']);
        $this->assertEquals($language, $book['language']);
        $this->assertEquals($releaseDate, $book['release_date']);
    }

    public function test_check_if_not_have_successfully_update_the_book(): void
    {
        $mockRequest = Mockery::mock(BookRequest::class);

        $mockRequest->shouldReceive('validated')
            ->andReturn([]);

        $book = $this->bookService->update($mockRequest, $this->book->id);

        $this->assertEquals($this->book->name, $book['name']);
        $this->assertEquals($this->book->synopsis, $book['synopsis']);
        $this->assertEquals($this->book->publisher, $book['publisher']);
        $this->assertEquals($this->book->edition, $book['edition']);
        $this->assertEquals($this->book->page_number, $book['page_number']);
        $this->assertEquals($this->book->isbn, $book['isbn']);
        $this->assertEquals($this->book->language, $book['language']);
        $this->assertEquals($this->book->release_date, $book['release_date']);
    }

    public function test_checks_if_the_book_has_been_successfully_deleted(): void
    {
        $deleted = $this->bookService->destroy($this->book->id);

        $this->assertTrue($deleted);
    }
}
