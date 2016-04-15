<?php
/**
 * Class ValidationException
 *
 * @author Anthony
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Support\MessageBag;

/**
 * Class ValidationException
 *
 * Custom exception type that inherits from the default PHP Exception class, provides a simple method for passing
 * well-formatted validation errors while failing validation on a POST.
 *
 * <h4>Example</h4>
 *
 * <code>
 * if ($validation->fails()) {
 *     //validation failed, throw an exception
 *     throw new ValidationException($validation->messages());
 * }
 * </code>
 */
class ValidationException extends Exception
{
    protected $_errors;

    /**
     * Set our custom error messages (using a Laravel MessageBag) and construct the parent Exception to allow default functionality
     *
     * @param mixed     $errors
     * @param string    $message
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($errors = null, $message = null, $code = 0, Exception $previous = null)
    {
        $this->_set_errors($errors);

        parent::__construct($message, $code, $previous);
    }

    /**
     * Set the _errors to create a Laravel MessageBag containing all of the AbstractValidator error messages
     *
     * @param $errors
     * @return void
     */
    protected function _set_errors($errors)
    {
        if (is_string($errors)) {
            $errors = array(
                'error' => $errors,
            );
        }

        if (is_array($errors)) {
            $errors = new MessageBag($errors);
        }

        $this->_errors = $errors;
    }

    /**
     * Get the _errors
     *
     * This is not intended as a substitute for client (caller) side validation.
     *
     * @param bool $formatted
     * @return string
     */
    public function get_errors($formatted = true)
    {
        if (!$formatted) {
            return $this->_errors;
        }

        $response = '';
        $errors   = $this->_errors->getMessages();

        foreach ($errors as $k => $v) {
            if (empty($response)) {
                $response = $k . ': ' . $v[0];
            } else {
                $response .= "<br>" . $k . ': ' . $v[0];
            }
        }

        return $response;
    }

    /**
     * return the associative array of field -> error
     *
     * this allows the calling site to properly display the error messages
     *
     * @return array
     */
    public function getErrorList()
    {
        return $this->_errors->getMessages();
    }
}
