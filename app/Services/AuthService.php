<?php

namespace App\Services;

use App\Repositories\Contracts\LogRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        private UserRepositoryContract $userRepository,
        private LogRepositoryContract $logRepository
    ) {}
    
    public function attempt(string $usernameOrEmail, string $password): array
    {
        // Try to find user by email or username
        $user = $this->userRepository->findByEmailOrUsername($usernameOrEmail);

        if (!$user) {
            return [
                'success' => false,
                'message' => trans('messages.login.user_not_found'),
            ];
        }

        if (!Hash::check($password, $user->password)) {
            return [
                'success' => false,
                'message' => trans('messages.login.wrong_password'),
            ];
        }

        // Login the user
        Auth::login($user);

        // Log the action
        $this->logRepository->create([
            'user_id' => $user->id,
            'action' => 'login',
            'description' => trans('messages.log.login', ['name' => $user->name]),
        ]);

        return [
            'success' => true,
            'message' => trans('messages.login.success'),
            'user' => $user,
        ];
    }
    
    public function logout(): void
    {
        $user = Auth::user();

        if ($user) {
            $this->logRepository->create([
                'user_id' => $user->id,
                'action' => 'logout',
                'description' => trans('messages.log.logout', ['name' => $user->name]),
            ]);
        }

        Auth::logout();
    }
}

