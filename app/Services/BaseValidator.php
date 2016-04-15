<?php
/**
 * Class BaseValidator
 *
 * @author Anthony Umpad
 */

namespace App\Services;

use Validator;
use App\Exceptions\ValidationException;

/**
 * Class BaseValidator
 *
 * Source for rules to validate a posts
 */
class BaseValidator
{
    /**
     * Validate the request
     *
     * Use Laravel's validator with our custom validation rules. Throw a ValidationException if there are errors,
     * otherwise return true.
     *
     * @param array $data
     *
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $validation = Validator::make($data, $this->rules, $this->custom_errors);

        if ($validation->fails()) {
            //validation failed, throw an exception
            throw new ValidationException($validation->messages(), $validation->messages());
        }
    }
}