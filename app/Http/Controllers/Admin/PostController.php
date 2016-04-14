<?php
/**
 * PostController
 *
 * @author Anthony Umpad
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use View;

/**
 * Class PostController
 * @package App\Http\Controllers\Admin
 *
 * This handles all Post requests
 */
class PostController extends Controller
{

    /**
     * all
     *
     * This renders the posts index page
     *
     * @return \Illuminate\View\View
     */
    public function all()
    {
        return Response::view('admin.post.list');
    }

    /**
     * create
     *
     * This renders the post create page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('admin.post.create-update')
            ->with('action', 'Create');
    }

    /**
     * edit
     *
     * This renders the post edit page
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return View::make('admin.post.create-update')
            ->with('action', 'Edit');
    }
}
