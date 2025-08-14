<?php

namespace App\Services;

use App\Interfaces\RepositoryInterface;
use App\Interfaces\BookRequestInterface;
use App\Interfaces\BookServiceInterface;
use App\Exceptions\BookNotFoundException;

class BookService implements BookServiceInterface
{

    public function __construct(private readonly RepositoryInterface $bookRepository) {}

    public function all(): array
    {
        $books = $this->bookRepository->paginate();

        return $books;
    }

    public function store(BookRequestInterface $request): array
    {
        $book = $this->bookRepository->create($request);

        return $book;
    }

    public function show(string $id): array
    {
        try {
            $book = $this->bookRepository->find($id);
        } catch (BookNotFoundException $e) {
            return [];
        }

        return $book;
    }

    public function update(BookRequestInterface $request, string $id): array
    {
        try {
            $book = $this->bookRepository->update($request, $id);
        } catch (BookNotFoundException $e) {
            return [];
        }

        return $book;
    }

    public function destroy(string $id): bool
    {
        try {
            $this->bookRepository->delete($id);
        } catch (BookNotFoundException $e) {
            return false;
        }

        return true;
    }
}
