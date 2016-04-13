<?php
/**
 * Middleware for Sentinel authentication
 */

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use View;

class AuthenticateWithSentinel
{
    /**
     * The Sentinel implementation.
     *
     * @var Sentinel
     */
    protected $sentinel;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Sentinel::check()) {
            return redirect('/');
        }

        $user = Sentinel::getUser();
        View::share('user', $user);
        return $next($request);
    }
}
