<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnsResourceMiddleware
{
    /**
     * Handle an incoming request.
     * Usage: middleware('owns:model,field')
     * Example: middleware('owns:offer,investor_id')
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $modelName, string $field = 'user_id'): Response
    {
        $routeParams = $request->route()?->parameters();
        if (!$routeParams) {
            return abort(403, 'No resource found.');
        }

        $resource = null;
        foreach ($routeParams as $param) {
            if ($param instanceof Model && strtolower(class_basename($param)) === strtolower($modelName)) {
                $resource = $param;
                break;
            }
        }

        if (!$resource) {
            return abort(403, 'Resource not found.');
        }

        $ownerValue = $resource->{$field};
        if ($ownerValue !== auth()->id()) {
            return abort(403, 'You do not own this resource.');
        }

        return $next($request);
    }
}
