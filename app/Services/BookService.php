<?php

namespace App\Services;

use App\Interfaces\BookServiceInterface;
use App\Interfaces\BookRequestInterface;
use App\Interfaces\RepositoryInterface;

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
        } catch (\Throwable $e) {
            return [];
        }

        return $book;
    }

    public function update(BookRequestInterface $request, string $id): array
    {
        try {
            $book = $this->bookRepository->update($request, $id);
        } catch (\Throwable $e) {
            return [];
        }

        return $book;
    }

    public function destroy(string $id): bool
    {
        try {
            $this->bookRepository->delete($id);
        } catch (\Throwable $e) {
            return false;
        }

        return true;
    }
}
