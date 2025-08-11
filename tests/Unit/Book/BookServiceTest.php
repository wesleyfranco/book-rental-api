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
        $this->bookService->destroy($this->book->id);
    }

    public function test_check_that_there_are_no_registered_books(): void
    {
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
}
