<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class ApiAuthentication extends Middleware
{
    use ApiResponse;

    private const HEADER_BEARER = 'authorization';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $bearerToken = $request->header(self::HEADER_BEARER);
        if ($bearerToken === null) {
            return $this->sendError('Unauthorized.', 401);
        }

        $bearerToken = $request->bearerToken();

        if (trim($bearerToken) !== config('services.api.token')) {
            return $this->sendError('Unauthorized.', 401);
        }

        return $next($request);
    }
}
