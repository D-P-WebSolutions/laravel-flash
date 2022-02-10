<?php

use DPWebSolutions\LaravelFlash\Flash;

// Return a new instance of flash class
if (!function_exists('flash')) {
    /**
     * Arrange for a flash message.
     *
     * @param null|string $message
     *
     * @return Flash
     */
    function flash($message = null)
    {
        return Flash::instance($message);
    }
}
