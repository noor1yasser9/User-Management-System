<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use App\Services\LogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogController extends Controller
{
    public function __construct(
        private LogService $logService
    ) {}

    /**
     * Display the logs page
     */
    public function index(): View
    {
        return view('logs.index');
    }

    /**
     * Get paginated logs list
     */
    public function list(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $logs = $this->logService->getAllLogsPaginated($perPage);

        return response()->json([
            'success' => true,
            'data' => $logs->items(),
            'pagination' => [
                'current_page' => $logs->currentPage(),
                'last_page' => $logs->lastPage(),
                'per_page' => $logs->perPage(),
                'total' => $logs->total(),
                'from' => $logs->firstItem(),
                'to' => $logs->lastItem(),
            ]
        ]);
    }
}

