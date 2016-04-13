<?php
/**
 * BaseController
 *
 * @author Anthony Umpad
 */

namespace App\Http\Controllers\Admin;

use Blade;
use View;
use Session;
use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Sentinel;

/**
 * Class BaseController
 * @package App\Http\Controllers\Admin
 *
 * Base Controller for blog admin
 */
class BaseController extends Controller
{

    public $user      = null;

    /**
     * Class Constructor
     *
     * @params Sentinel sentinel
     */
    public function __construct(Sentinel $sentinel)
    {
        $this->user = $sentinel->getUser();
    }
}
