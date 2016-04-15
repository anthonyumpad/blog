<?php
/**
 * Class CategoryValidator
 *
 * @author Anthony Umpad
 */

namespace App\Services;

use Validator;
use App\Exceptions\ValidationException;

/**
 * Class PostValidator
 *
 * Source for rules to validate a posts
 */
class CategoryValidator extends BaseValidator
{

    public $rules = [
        'uid'  => ['required'],
        'name' => ['required'],
        'type' => ['required']
    ];

    public $custom_errors = [
        'required' => 'This is a required field',
    ];
}