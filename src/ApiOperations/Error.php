<?php
namespace Safimoney\ApiOperations;

class Error
{
    public function createErrorResponse($message)
    {
        $error = new \stdClass();
        $error->error = true;
        $error->message = $message;
        return $error;
    }
}