<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private readonly UserService $userService
    ) {}

    /**
     * Display the users page
     */
    public function index(): View
    {
        return view('users.index');
    }

    /**
     * Get all users (AJAX) with pagination
     */
    public function list(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);

        // Validate per_page value
        if (!in_array($perPage, [5, 10, 25, 50])) {
            $perPage = 10;
        }

        $users = $this->userService->getAllUsersPaginated($perPage);

        return $this->successResponse(trans('messages.user.list_retrieved'), [
            'data' => $users->items(),
            'current_page' => $users->currentPage(),
            'last_page' => $users->lastPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
            'from' => $users->firstItem(),
            'to' => $users->lastItem(),
        ]);
    }

    /**
     * Store a new user (AJAX)
     */
    public function store(UserRequest $request): JsonResponse
    {
        $result = $this->userService->createUser($request->validated());

        if ($result['success']) {
            return $this->successResponse($result['message'], $result['user']);
        }

        return $this->errorResponse($result['message']);
    }

    /**
     * Update a user (AJAX)
     */
    public function update(UserRequest $request): JsonResponse
    {
      
        $data = $request->validated();

        $result = $this->userService->updateUser($data['id'], $data);

        if ($result['success']) {
            return $this->successResponse($result['message'], $result['user']);
        }

        return $this->errorResponse($result['message']);
    }

    /**
     * Delete a user (AJAX)
     */
    public function destroy(Request $request): JsonResponse
    {
        $id = $request->route('id');
        $result = $this->userService->deleteUser($id);

        if ($result['success']) {
            return $this->successResponse($result['message']);
        }

        return $this->errorResponse($result['message']);
    }
}

