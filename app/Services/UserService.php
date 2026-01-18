<?php

namespace App\Services;

use App\Repositories\Contracts\LogRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(
        private UserRepositoryContract $userRepository,
        private LogRepositoryContract $logRepository
    ) {}
    
    public function getAllUsers(): Collection
    {
        return $this->userRepository->getAll();
    }

    public function getAllUsersPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->userRepository->getAllPaginated($perPage);
    }
    
    public function createUser(array $data): array
    {
        try {
            $user = $this->userRepository->create($data);

            // Log the action
            $currentUser = Auth::user();
            $this->logRepository->create([
                'user_id' => $currentUser?->id,
                'action' => 'add',
                'description' => trans('messages.log.user_added', [
                    'actor' => $currentUser?->name,
                    'target' => $user->name
                ]),
            ]);

            return [
                'success' => true,
                'message' => trans('messages.user.created'),
                'user' => $user,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => trans('messages.user.create_failed') . ': ' . $e->getMessage(),
            ];
        }
    }
    
    public function updateUser($id, array $data): array
    {
        try {
        
            $user = $this->userRepository->findById($id);

            if (!$user) {
                return [
                    'success' => false,
                    'message' => trans('messages.user.not_found'),
                ];
            }

            $oldName = $user->name;
            $updated = $this->userRepository->update($id, $data);

            if ($updated) {
                // Log the action
                $currentUser = Auth::user();
                $this->logRepository->create([
                    'user_id' => $currentUser?->id,
                    'action' => 'edit',
                    'description' => trans('messages.log.user_updated', [
                        'actor' => $currentUser?->name,
                        'target' => $oldName
                    ]),
                ]);

                return [
                    'success' => true,
                    'message' => trans('messages.user.updated'),
                    'user' => $this->userRepository->findById($id),
                ];
            }

            return [
                'success' => false,
                'message' => trans('messages.user.update_failed'),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => trans('messages.user.update_failed') . ': ' . $e->getMessage(),
            ];
        }
    }
    
    public function deleteUser($id): array
    {
        try {
            $user = $this->userRepository->findById($id);

            if (!$user) {
                return [
                    'success' => false,
                    'message' => trans('messages.user.not_found'),
                ];
            }

            $userName = $user->name;
            $deleted = $this->userRepository->delete($id);

            if ($deleted) {
                // Log the action
                $currentUser = Auth::user();
                $this->logRepository->create([
                    'user_id' => $currentUser?->id,
                    'action' => 'delete',
                    'description' => trans('messages.log.user_deleted', [
                        'actor' => $currentUser?->name,
                        'target' => $userName
                    ]),
                ]);

                return [
                    'success' => true,
                    'message' => trans('messages.user.deleted'),
                ];
            }

            return [
                'success' => false,
                'message' => trans('messages.user.delete_failed'),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => trans('messages.user.delete_failed') . ': ' . $e->getMessage(),
            ];
        }
    }
}

