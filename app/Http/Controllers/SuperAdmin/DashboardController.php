<?php
/**
 * DashboardController
 *
 * @author Anthony Umpad
 */

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Log;
use View;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;

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
     * This creates the admin dashboard page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userCount          = User::with(['roles' => function($q){
                                $q->where('name', 'admin');
                            }])->count();
        $categoryCount      = Category::count();
        $postCount          = Post::count();
        $draftPostCount     = Post::where('status', Post::STATUS_DRAFT)->count();
        $publishedPostCount = Post::where('status', Post::STATUS_PUBLISHED)->count();
        $deletedPostCount   = Post::onlyTrashed()->count();

        return Response::view('superadmin.dashboard',[
                'userCount'          => $userCount,
                'categoryCount'      => $categoryCount,
                'postCount'          => $postCount,
                'draftPostCount'     => $draftPostCount,
                'publishedPostCount' => $publishedPostCount,
                'deletePostCount'    => $deletedPostCount
            ]);

    }
}
