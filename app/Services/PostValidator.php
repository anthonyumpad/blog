<?php
/**
 * Class PostValidator
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
class PostValidator extends BaseValidator
{

    public $rules = [
        'uid' => ['required'],
        'title' => ['required_without_all:description, tags, content'],
        'description' => ['required_without_all:title, tags, content'],
        'tags' => ['required_without_all:title, description, content'],
        'content' => ['required_without_all:title, tags, description'],
    ];

    public $custom_errors = [
        'required' => 'This is a required field',
        'required_without_all' => 'At least one field must be filled out',
    ];
}