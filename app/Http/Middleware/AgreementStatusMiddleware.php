<?php

namespace App\Http\Middleware;

use App\Models\Agreement;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgreementStatusMiddleware
{
    /**
     * Handle an incoming request.
     * Validates agreement is in the required status before proceeding.
     * Usage: middleware('agreement.status:sent_to_entrepreneur')
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$allowedStatuses): Response
    {
        $agreement = $request->route('agreement');

        if (!$agreement instanceof Agreement) {
            return abort(403, 'Agreement not found.');
        }

        if (!in_array($agreement->status, $allowedStatuses)) {
            $expected = implode(', ', $allowedStatuses);
            return back()->with('error', "Agreement status is {$agreement->status}. Expected: {$expected}");
        }

        return $next($request);
    }
}
