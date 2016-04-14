<?php
/**
 * Class AuthRepository
 *
 * @author AnthonyUmpad
 * @copyright 2016
 */

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

    /**
     * authenticate
     *
     * This performs admin authentication.
     * This checks the role as to which group the user belongs to.
     *
     * @param Request $request
     * @throws Exception
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);

        $auth = Sentinel::authenticateAndRemember($request->all());
        if (! $auth) {
            return Redirect::back()
                ->withInput($request->except('password'))
                ->with('flash_message', [
                    'status'  => 'error',
                    'message' => 'Invalid email/password!'
                ]);
        }

        return Redirect::route('admin.dashboard');
    }

    /**
     * logout
     *
     * Logs out the current admin user and destroys all
     * Session keys.
     *
     * @return Redirect
     */
    public function logout()
    {
        Sentinel::logout(Sentinel::getUser());
        return Redirect::to('/');
    }
}
