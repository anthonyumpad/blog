<?php
/**
 * Class UserValidator
 *
 * @author Anthony Umpad
 */

namespace App\Services;

use Validator;
use App\Exceptions\ValidationException;

/**
 * Class UserValidator
 *
 * Source for rules to validate a posts
 */
class UserValidator extends BaseValidator
{

    public $rules = [
        'email'      => ['required'],
        'password'   => ['required'],
        'username'   => ['required'],
        'type'       => ['required']
    ];

    public $custom_errors = [
        'required' => 'This is a required field',
    ];
}