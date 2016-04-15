<?php
/**
 * DashboardController
 *
 * @author Anthony Umpad
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Log;
use View;
use App\Models\Category;
use App\Models\Post;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 *
 * This handles all Dashboard requests
 */
class DashboardController extends Controller
{

    /**
     * index
     *
     * This creates the dashboard page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user               = Sentinel::getUser();
        $categoryCount      = Category::where('user_id', $user->id)->count();
        $postCount          = Post::where('user_id', $user->id)->count();
        $draftPostCount     = Post::where('user_id', $user->id)->where('status', Post::STATUS_DRAFT)->count();
        $publishedPostCount = Post::where('user_id', $user->id)->where('status', Post::STATUS_PUBLISHED)->count();
        $deletedPostCount   = Post::where('user_id', $user->id)->onlyTrashed()->count();

        return Response::view('admin.dashboard',[
            'categoryCount'          => $categoryCount,
                'postCount'          => $postCount,
                'draftPostCount'     => $draftPostCount,
                'publishedPostCount' => $publishedPostCount,
                'deletePostCount'    => $deletedPostCount
            ]);

    }
}
