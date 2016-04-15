<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

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

    /**
     * getUserPost
     *
     * This fetches and displays the user's post
     *
     * @param $userName
     * @param $postId
     */
    public function getUserPost(Request $request, $userName, $postId)
    {
        $preview = (! empty($request->get('preview'))) ? $request->get('preview') : false;
        Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
            'getUserPost', [
                'username' => $userName,
                'postId'   => $postId
        ]);

        $user = User::where('username', $userName)->first();
        $post = Post::where('user_id', $user->id)
                    ->where('_id', $postId);

        if (! $preview) {
              $post = $post->where('status', POST::STATUS_PUBLISHED);
        }

        $post = $post->first();
        if(empty($post)) {
            App::abort(404);
        }

        return View::make('blog.post')
            ->with([
                "post" => $post
            ]);
    }
}
