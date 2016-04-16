<?php
/**
 * Class UserRepository
 *
 * @author Anthony
 */

namespace App\Repositories;

use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Webpatser\Uuid\Uuid;

/**
 * Class UserRepository
 *
 * This performs all User related data request
 */
class UserRepository
{
    /**
     * paginatedList
     *
     * This queries and returns a paginated list of users
     *
     * @param Request $request
     * @return User(Collection)
     * @throws Exception
     */
    public function paginatedList(Request $request)
    {
        $limit  = (! empty($request->get('limit')))  ? $request->get('limit')  : 10;
        $sortBy = (! empty($request->get('sortBy'))) ? $request->get('sortBy') : '';
        /*
            sortByDateDesc
            sortByDateAsc
            sortByUserName
        */
        if ($sortBy == 'sortByDateDesc') {
            $users = User::orderBy('created_at', 'desc');
        } elseif($sortBy == 'sortByDateAsc') {
            $users = User::orderBy('created_at', 'asc');
        } elseif($sortBy == 'sortByUserName') {
            $users = User::orderBy('username', 'asc');
        } else {
            $users = User::paginate((int) $limit);
            return $users;
        }

        $users = $users->paginate((int) $limit);
        return $users;
    }

    /**
     * createUpdate
     *
     * This creates or updates a user using Sentinel
     *
     * @param array $input
     * @throws Exception
     */
    public function createUpdate(Request $request)
    {
        $input    = $request->all();
        $uid      = (! empty($input['uid']))      ? $input['uid']      : '';
        $email    = (! empty($input['email']))    ? $input['email']    : '';
        $username = (! empty($input['username'])) ? $input['username'] : '';
        $type     = (! empty($input['type']))      ? $input['type']    : '';
        $role     = Sentinel::findRoleBySlug($type);

        if (empty($role)) {
            throw new \Exception("Cannot find Sentinel user role.");
        }

        // if empty means this is a new user
        // check user email and username is unique
        if (empty($uid)) {
            $existingUser = User::where('username', $username)
                            ->orWhere('email', $email)
                            ->first();
            if (! empty($existingUser)) {
                throw new \Exception('Username or email already exist.');
            }

            try {
                $newUser = Sentinel::registerAndActivate([
                    "email"      => $email,
                    "password"   => (! empty($input['password']))  ? $input['password']     : 'password',
                ]);

                $newUser->username    = $username;
                $newUser->first_name  = (! empty($input['first_name'])) ? $input['first_name']  : '';
                $newUser->last_name   = (! empty($input['last_name']))  ? $input['last_name']   : '';
                $newUser->uid         = Uuid::generate(4);
                $newUser->save();
                $newUser->roles()->attach($role);
                return $newUser;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        // edit user
        // we can only edit the first_name, last_name, password
        // don't ever edit the username and email
        $existingUser = User::where('uid', $uid)->first();
        if (empty($existingUser)) {
            throw new \Exception('User record not found');
        }

        $credentials = [
            'email'     => $existingUser->email,
            'password'  => (! empty($input['password'])) ? $input['password'] : 'password'
        ];

        // update user details first
        try {
            $existingUser->first_name = (! empty($input['first_name'])) ? $input['first_name'] : '';
            $existingUser->last_name  = (! empty($input['last_name'])) ? $input['last_name']   : '';
            $existingUser->save();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        try {
            $user = Sentinel::update($existingUser, $new_credentials);
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return $user;

    }
}