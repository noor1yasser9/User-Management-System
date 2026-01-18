<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryContract;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryContract
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findByEmailOrUsername(string $usernameOrEmail): ?User
    {
        return User::where('email', $usernameOrEmail)
            ->orWhere('username', $usernameOrEmail)
            ->first();
    }

    public function findById($id): ?User
    {
        return User::find($id);
    }
    
    public function getAll(): Collection
    {
        $currentUserId = Auth::id();
        return User::where('id', '!=', $currentUserId)->get();
    }

    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        $currentUserId = Auth::id();
        return User::where('id', '!=', $currentUserId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
    
    public function create(array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        return User::create($data);
    }
    
    public function update($id, array $data): bool
    {
        $user = $this->findById($id);
        
        if (!$user) {
            return false;
        }
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }else {
            unset($data['password']);
        }
        
        return $user->update($data);
    }
    
    public function delete($id): bool
    {
        $user = $this->findById($id);
        
        if (!$user) {
            return false;
        }
        
        return $user->delete();
    }
}

