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
     * This checks the role as to which group the user belongs to as well.
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

        if ($auth->inRole('admin')) {
            return Redirect::route('admin.dashboard');
        }

        if ($auth->inRole('superadmin')) {
            return Redirect::route('superadmin.dashboard');
        }
    }

    /**
     * change Password
     *
     * Change the user's password
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function changePassword(Request $request)
    {
        $params = $request->all();
        $user = Sentinel::getUser();
        $credentials = [
            'email'     => $user->email,
            'password'  => (! empty($params['currentPassword'])) ? $params['currentPassword'] : ''
        ];
        $re_auth_user = Sentinel::validateCredentials($user, $credentials);

        //check if current password is correct
        if (! $re_auth_user) {
            return Redirect::back()->with([
                'passwordErrors'   => 'Current password is incorrect'
            ]);
        }

        //check if new passwords match
        $new_pass     = (! empty($params['newPassword']))    ? $params['newPassword'] : '';
        $re_new_pass  = (! empty($params['re-newPassword'])) ? $params['re-newPassword'] : '';
        if ($new_pass != $re_new_pass) {
            return Redirect::back()->with([
                'passwordErrors'   => 'New passwords does not match'
            ]);
        }

        $new_credentials = ['password' => $params['newPassword']];
        $user = Sentinel::update($user, $new_credentials);

        return Redirect::route('admin.login')
            ->with([
                'success-message' => 'Password successfully changed. Please login with your new password.'
            ]);
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
