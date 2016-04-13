<?php
/**
 * DashboardController
 *
 * @author Anthony Umpad
 */

namespace App\Http\Controllers\Admin;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Log;
use View;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 *
 * This handles all Dashboard requests
 */
class DashboardController extends BaseController
{

    /**
     * Class Constructor
     */
    public function __construct()
    {

    }

    /**
     * index
     *
     * This creates the dashboard page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return Response::view('admin.dashboard');
    }
}
