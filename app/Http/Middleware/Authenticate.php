<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, ...$guards): Response
    {
        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * Redirect unauthenticated users.
     */
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            session()->flash('message', 'يجب أن تسجل الدخول قبل حجز المواعيد');
            return url()->previous() ?? '/';
        }

        return null;
    }
}
