<?php

namespace App\Repositories;

use App\Repositories\Contracts\LogRepositoryContract;
use App\Models\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LogRepository implements LogRepositoryContract
{
    public function create(array $data): Log
    {
        return Log::create($data);
    }

    public function getAll(): Collection
    {
        return Log::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Log::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}

