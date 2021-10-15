<?php

namespace App\Repository;

use App\Entity\Todo;

interface TodoRepository
{
    public function save(Todo $todo): void;
    public function findAll(): array;
    public function find(string $id): ?Todo;
}
