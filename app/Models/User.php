<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

class User extends CartalystUser
{
    protected $connection = 'mysql';
    protected $fillable   = [
        'username',
        'uid',
        'email',
        'first_name',
        'last_name',
        'password',
    ];
    use SoftDeletes;
}
