<?php

namespace Tests\Unit\Book;

use Mockery;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Support\Str;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
use App\Interfaces\RepositoryInterface;
use App\Interfaces\BookServiceInterface;
use App\Repositories\BookRepositoryEloquent;

class BookServiceTest extends TestCase
{
    private string $name;
    private string $synopsis;
    private string $publisher;
    private string $edition;
    private int $pageNumber;
    private string $isbn;
    private string $language;
    private string $releaseDate;
    private RepositoryInterface $bookRepository;
    private BookServiceInterface $bookService;

    public function setUp(): void
    {
        parent::setUp();

        $this->name = fake()->sentence(5);
        $this->synopsis = fake()->text();
        $this->publisher = Str::random(10);
        $this->edition = (string) fake()->randomDigit();
        $this->pageNumber = fake()->randomNumber(3);
        $this->isbn = fake()->isbn13();
        $this->language = Str::random(10);
        $this->releaseDate = fake()->date();

        $this->bookRepository = new BookRepositoryEloquent(new Book);
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
                'name' => $this->name,
                'synopsis' => $this->synopsis,
                'publisher' => $this->publisher,
                'edition' => $this->edition,
                'page_number' => $this->pageNumber,
                'isbn' => $this->isbn,
                'language' => $this->language,
                'release_date' => $this->releaseDate,
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
        $mockRequest = Mockery::mock(BookRequest::class);

        $mockRequest->shouldReceive('validated')
            ->andReturn([
                'name' => $this->name,
                'synopsis' => $this->synopsis,
                'publisher' => $this->publisher,
                'edition' => $this->edition,
                'page_number' => $this->pageNumber,
                'isbn' => $this->isbn,
                'language' => $this->language,
                'release_date' => $this->releaseDate,
            ]);

        $book = $this->bookService->update($mockRequest, $this->book->id);

        $this->assertEquals($this->name, $book['name']);
        $this->assertEquals($this->synopsis, $book['synopsis']);
        $this->assertEquals($this->publisher, $book['publisher']);
        $this->assertEquals($this->edition, $book['edition']);
        $this->assertEquals($this->pageNumber, $book['page_number']);
        $this->assertEquals($this->isbn, $book['isbn']);
        $this->assertEquals($this->language, $book['language']);
        $this->assertEquals($this->releaseDate, $book['release_date']);
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

    public function test_checks_if_the_book_has_not_successfully_deleted(): void
    {
        $deleted = $this->bookService->destroy('abc');

        $this->assertFalse($deleted);
    }
}
