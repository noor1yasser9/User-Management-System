<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private AuthService $authService
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->attempt(
            $request->input('email'),
            $request->input('password')
        );

        if ($result['success']) {
            $locale = $request->route('locale', 'ar');
            return $this->successResponse(
                $result['message'],
                [
                    'user' => $result['user'],
                    'redirect_url' => route('users.index', ['locale' => $locale])
                ]
            );
        }

        return $this->unauthorizedResponse($result['message']);
    }
}

