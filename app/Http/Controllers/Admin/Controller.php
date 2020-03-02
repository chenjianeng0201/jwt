<?php

namespace App\Http\Controllers\Admin;

use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function errorResponse($statusCode, $message = null, $code = 0)
    {
        throw new HttpException($statusCode, $message, null, [], $code);
    }
}
