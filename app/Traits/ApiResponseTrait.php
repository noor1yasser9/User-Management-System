<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Return a success JSON response
     *
     * @param string $message
     * @param mixed $data
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function successResponse(string $message, mixed $data = null, int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return an error JSON response
     *
     * @param string $message
     * @param mixed $errors
     * @param int $statusCode
     * @return JsonResponse
     */
    protected function errorResponse(string $message, mixed $errors = null, int $statusCode = 400): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return a validation error response
     *
     * @param array $errors
     * @param string|null $message
     * @return JsonResponse
     */
    protected function validationErrorResponse(array $errors, ?string $message = null): JsonResponse
    {
        $message = $message ?? trans('messages.general.validation_error');
        return $this->errorResponse($message, $errors, 422);
    }

    /**
     * Return a not found response
     *
     * @param string|null $message
     * @return JsonResponse
     */
    protected function notFoundResponse(?string $message = null): JsonResponse
    {
        $message = $message ?? trans('messages.general.not_found');
        return $this->errorResponse($message, null, 404);
    }

    /**
     * Return an unauthorized response
     *
     * @param string|null $message
     * @return JsonResponse
     */
    protected function unauthorizedResponse(?string $message = null): JsonResponse
    {
        $message = $message ?? trans('messages.general.unauthorized');
        return $this->errorResponse($message, null, 401);
    }

    /**
     * Return a forbidden response
     *
     * @param string|null $message
     * @return JsonResponse
     */
    protected function forbiddenResponse(?string $message = null): JsonResponse
    {
        $message = $message ?? trans('messages.general.forbidden');
        return $this->errorResponse($message, null, 403);
    }

    /**
     * Return a server error response
     *
     * @param string|null $message
     * @return JsonResponse
     */
    protected function serverErrorResponse(?string $message = null): JsonResponse
    {
        $message = $message ?? trans('messages.general.server_error');
        return $this->errorResponse($message, null, 500);
    }
}

