<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function all(): array;

    public function paginate(): array;

    public function create(BookRequestInterface $request): array;

    public function find(string $id): array;

    public function update(BookRequestInterface $request, string $id): array;

    public function delete(string $id): bool;
}
