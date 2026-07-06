<?php

namespace App\Http\Middleware;

use App\Models\Agreement;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FileDownloadMiddleware
{
    /**
     * Handle an incoming request.
     * Ensures user can only download their own agreement files.
     * Usage: middleware('file.download')
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agreement = $request->route('agreement');

        if (!$agreement instanceof Agreement) {
            return abort(403, 'Agreement not found.');
        }

        $userId = auth()->id();
        if ($agreement->entrepreneur_id !== $userId && $agreement->investor_id !== $userId) {
            return abort(403, 'You cannot access this file.');
        }

        return $next($request);
    }
}
