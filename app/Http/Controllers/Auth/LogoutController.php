<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $locale = $request->route('locale', 'ar');
        $this->authService->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login', ['locale' => $locale])->with('success', trans('messages.logout.success'));
    }
}

