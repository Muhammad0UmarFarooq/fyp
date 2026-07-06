<?php

namespace App\Http\Middleware;

use App\Models\Pitch;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PitchStatusMiddleware
{
    /**
     * Handle an incoming request.
     * Validates pitch is in the required status before proceeding.
     * Usage: middleware('pitch.status:active')
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$allowedStatuses): Response
    {
        $pitch = $request->route('pitch');

        if (!$pitch instanceof Pitch) {
            return abort(403, 'Pitch not found.');
        }

        if (!in_array($pitch->status, $allowedStatuses)) {
            $expected = implode(', ', $allowedStatuses);
            return back()->with('error', "Pitch status is {$pitch->status}. Expected: {$expected}");
        }

        return $next($request);
    }
}
