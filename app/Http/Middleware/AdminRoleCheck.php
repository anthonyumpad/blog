<?php
/**
 * Middleware for Sentinel authentication
 * and role check
 */

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use View;

class AdminRoleCheck
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

        if (! $user->inRole('admin')) {
            return redirect('/');
        }

        return $next($request);
    }
}
