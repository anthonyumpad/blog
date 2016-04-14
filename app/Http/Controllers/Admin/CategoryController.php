<?php
/**
 * CategoryController
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
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 *
 * This handles all Category requests
 */
class CategoryController extends Controller
{

    /**
     * all
     *
     * This renders the categories index page
     *
     * @return \Illuminate\View\View
     */
    public function all()
    {
        return Response::view('admin.category.list');
    }

    /**
     * create
     *
     * This renders the category create page
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('admin.category.create-update')
            ->with('action', 'Create');
    }

    /**
     * edit
     *
     * This renders the category edit page
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return View::make('admin.category.create-update')
            ->with('action', 'Edit');
    }
}
