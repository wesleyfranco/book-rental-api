<?php

namespace App\Interfaces;

use App\Interfaces\BookRequestInterface;

interface BookServiceInterface
{
    public function all(): array;

    public function store(BookRequestInterface $request): array;

    public function show(string $id): array;

    public function update(BookRequestInterface $request, string $id): array;

    public function destroy(string $id): bool;
}
