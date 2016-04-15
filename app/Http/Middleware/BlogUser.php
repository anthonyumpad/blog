<?php
/**
 * Middleware for public blog user link
 */

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Category;
use View;
use Illuminate\Support\Facades\App;

class BlogUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $segments = $request->segments();
        // 0 = blog
        // 1 = $username
        $user  = User::where('username', $segments[1])->first();
        if (empty($user)) {
            App::abort(404);
        }
        $categories = Category::where('user_id', $user->id)->get();
        View::share('categories', $categories);
        View::share('username',   $user->username);
        return $next($request);
    }
}
