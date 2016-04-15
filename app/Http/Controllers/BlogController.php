<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * getUserIndex
     *
     * This renders the index page for the user
     *
     * @param $userName
     */
    public function getUserIndex(Request $request, $userName)
    {
        $user = User::where('username', $userName)->first();
        $categoryId = (! empty($request->get('category'))) ? $request->get('category') : '';
        $search     = (! empty($request->get('search')))   ? $request->get('search')   : '';
        $posts      = Post::select(['title', 'description', 'created_at', 'category_id'])
                    ->where('user_id', $user->id)
                    ->where('status', Post::STATUS_PUBLISHED)
                    ->with('category')
                    ->orderBy('created_at', 'desc');

        if (! empty($categoryId)) {
            $posts = $posts->where('category_id', $categoryId);
        }

        if (! empty($search)) {
            $posts = $posts->orWhere('content', 'regexp', '/'.$search.'/')
                    ->orWhere('description', 'regexp', '/'.$search.'/');
        }

        $posts = $posts->simplePaginate(2);
        return View::make('blog.home')
            ->with([
                "username"   => $user->username,
                "posts"      => $posts
            ]);
    }
}