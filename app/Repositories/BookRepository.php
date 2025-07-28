<?php

namespace App\Repositories;

use App\Models\Book;
use App\Interfaces\RepositoryInterface;
use App\Interfaces\BookRequestInterface;

class BookRepository implements RepositoryInterface
{

    public function __construct(private readonly Book $book)
    {
    }

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
        $book = $this->book->findOrFail($id);

        return $book->toArray();
    }

    public function update(BookRequestInterface $request, string $id): array
    {
        $book = $this->book->findOrFail($id);
        $book->update($request->validated());

        return $book->toArray();
    }

    public function delete(string $id): bool
    {
        $book = $this->book->findOrFail($id);
        $deleted = $book->delete();

        return (bool) $deleted;
    }
}
