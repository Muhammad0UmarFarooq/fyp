<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileCompleteMiddleware
{
    /**
     * Handle an incoming request.
     * Ensures user has a complete profile before proceeding.
     * Usage: middleware('profile.complete:entrepreneur') or middleware('profile.complete:investor')
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        $user = auth()->user();

        if (!$user) {
            return back()->with('error', 'Please log in.');
        }

        if ($role && $user->role !== $role) {
            return abort(403, 'Invalid role.');
        }

        $requiredFields = match ($user->role) {
            'entrepreneur' => ['name', 'email', 'phone', 'city'],
            'investor' => ['name', 'email', 'phone', 'city'],
            default => [],
        };

        foreach ($requiredFields as $field) {
            if (!$user->{$field}) {
                return redirect()->route($user->role . '.profile')
                    ->with('error', 'Please complete your profile before proceeding.');
            }
        }

        return $next($request);
    }
}
