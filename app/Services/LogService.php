<?php

namespace App\Services;

use App\Repositories\Contracts\LogRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LogService
{
    public function __construct(
        private LogRepositoryContract $logRepository
    ) {}

    public function getAllLogs(): Collection
    {
        return $this->logRepository->getAll();
    }

    public function getAllLogsPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->logRepository->getAllPaginated($perPage);
    }
}

