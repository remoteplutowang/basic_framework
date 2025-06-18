<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\Handler;
use Illuminate\Validation\ValidationException;
use App\Exceptions\CommonException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'decrypt.parameter'=> App\Http\Middleware\DecryptParam::class,
            'auth'=> App\Http\Middleware\Authenticate::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (\Exception $exp, $request) {
            $errorCode = $exp->getCode();
            $status = 200;
            if($exp instanceof ValidationException){
                $errorCode = CommonException::CONST_ERROR_PARAMETER_INVALID;
            }
            if($exp->getCode() == CommonException::CONST_ERROR_AUTH_TOKEN_INVALID){
                $status = 401;
            }
            if(empty($errorCode)){
                $errorCode = CommonException::CONST_ERROR_SYSTEM;
            }
            return response()->json([
                'err_code' => $errorCode,
                'err_msg' => $exp->getMessage(),
                'data' => [],
            ], $status);
        });
    })->create();
