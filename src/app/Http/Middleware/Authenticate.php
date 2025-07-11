<?php

namespace App\Http\Middleware;

use App\Exceptions\CommonException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        throw new CommonException("",CommonException::CONST_ERROR_AUTH_TOKEN_INVALID);
    }
}
