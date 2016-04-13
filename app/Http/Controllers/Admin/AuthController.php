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
use Cartalyst\Sentinel\Native\Facades\Sentinel;

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


        $auth = Sentinel::authenticate($request->all());

    }
}
