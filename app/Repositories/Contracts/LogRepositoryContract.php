<?php

namespace App\Repositories\Contracts;

use App\Models\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface LogRepositoryContract
{
    public function create(array $data): Log;

    public function getAll(): Collection;

    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator;
}

