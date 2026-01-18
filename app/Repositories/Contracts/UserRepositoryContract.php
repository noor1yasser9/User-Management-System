<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryContract
{
    public function findByEmail(string $email): ?User;

    public function findByEmailOrUsername(string $usernameOrEmail): ?User;

    public function findById($id): ?User;

    public function getAll(): Collection;

    public function create(array $data): User;

    public function update($id, array $data): bool;

    public function delete($id): bool;
}

