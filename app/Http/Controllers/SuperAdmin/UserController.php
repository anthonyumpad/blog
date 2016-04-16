<?php
/**
 * UserController
 *
 * @author Anthony Umpad
 */

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use App\Exceptions\ValidationException;
use App\Services\UserValidator;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Category;
use View;
use Log;
use Illuminate\Support\Facades\Session;
use Webpatser\Uuid\Uuid;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 *
 * This handles all User requests
 */
class UserController extends Controller
{

    /**
     * constructor
     *
     * Inject some dependency
     */
    public function __construct(UserValidator $userValidator, UserRepository $userRepository)
    {
        $this->userValidator  = $userValidator;
        $this->userRepository = $userRepository;
    }

    /**
     * all
     *
     * This renders the users index page
     *
     * @return \Illuminate\View\View
     */
    public function all(Request $request)
    {
        $users = $this->userRepository->paginatedList($request);

        //frontend data
        $data = [
            'users'  => $users,
            'limit'  => (! empty($request->get('limit')))   ? $request->get('limit') : '10',
            'sortBy' => (! empty($request->get('sortBy')))  ? $request->get('sortBy') : 'sortByDateDesc',
        ];

        if (Session::has('flash_message')) {
           $data['flash_message'] = Session::get('flash_message');
        }
        return View::make('superadmin.user.list')
            ->with($data);
    }

    /**
     * createAction
     *
     * This renders the user create page
     *
     * @return \Illuminate\View\View
     */
    public function createAction()
    {
        return View::make('superadmin.user.create-update')
            ->with('action', 'Create');
    }

    /**
     * editAction
     *
     * This renders the user edit page
     *
     * @return \Illuminate\View\View
     */
    public function editAction($userUid)
    {
        $editUser = User::with('roles')
            ->where('uid', $userUid)
            ->first();

        if (empty($editUser)) {
            return View::make('superadmin.user.create-update')
                ->with('action', 'Create');
        }

        return View::make('superadmin.user.create-update')
            ->with([
                'blogUser' => $editUser,
                'action'   =>'Edit'
            ]);
    }

    /**
     * create
     *
     * This creates a new user for the site
     *
     * @param Request $request
     */
    public function create(Request $request)
    {
        try {
            $this->userValidator->validate($request->all());
        } catch (ValidationException $e) {
            $errors      = $e->getErrorList();
            $error_array = [];
            foreach ($errors as $field => $errormessage) {
                $error_array[] =  $field .":" .$errormessage[0];
            }
            return Redirect::back()
                ->withInput($request->except(['_token', '_url']))
                ->withErrors($error_array);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Create post  exception.', ['exception', $e->getMessage()]);
            return Redirect::back()
                ->withInput($request->except(['_token', '_url']))
                ->withErrors([$e->getMessage()]);
        }

        try {
          $newUser = $this->userRepository->createUpdate($request);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . ':' . __TRAIT__ . ':' . __FILE__ . ':' . __LINE__ . ':' . __FUNCTION__ . ':' .
                'Create post  exception.', ['exception', $e->getMessage()]);
            return Redirect::back()
                ->withInput($request->except(['_token', '_url']))
                ->withErrors([$e->getMessage()]);
        }

        return Redirect::route('superadmin.user.get.list')
            ->with('flash_message', [
            'status'  => 'success',
            'message' => 'User '. $request->get('username') .' was successfully added/updated.'
         ]);
    }
}
