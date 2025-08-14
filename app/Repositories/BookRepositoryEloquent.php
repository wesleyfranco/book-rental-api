<?php

namespace App\Repositories;

use App\Models\Book;
use App\Interfaces\RepositoryInterface;
use App\Interfaces\BookRequestInterface;
use App\Exceptions\BookNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookRepositoryEloquent implements RepositoryInterface
{

    public function __construct(private readonly Book $book) {}

    public function all(): array
    {
        $books = $this->book->all();

        return $books->toArray();
    }

    public function paginate(): array
    {
        $books = $this->book->paginate();

        return $books->toArray();
    }

    public function create(BookRequestInterface $request): array
    {
        $this->book->fill($request->validated());
        $this->book->save();

        return $this->book->toArray();
    }

    public function find(string $id): array
    {
        try {
            $book = $this->book->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new BookNotFoundException('Book not found');
        }

        return $book->toArray();
    }

    public function update(BookRequestInterface $request, string $id): array
    {
        try {
            $book = $this->book->findOrFail($id);
            $book->update($request->validated());
        } catch (ModelNotFoundException $e) {
            throw new BookNotFoundException('Book not found');
        }

        return $book->toArray();
    }

    public function delete(string $id): bool
    {
        try {
            $book = $this->book->findOrFail($id);
            $deleted = $book->delete();
        } catch (ModelNotFoundException $e) {
            throw new BookNotFoundException('Book not found');
        }

        return (bool) $deleted;
    }
}
