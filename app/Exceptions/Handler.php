<?php

namespace App\Exceptions;

use App\Http\Controllers\api\v1\ApiController;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {


        $this->renderable(function (NotFoundHttpException $e,$request){
            if ($request->is('api/*')){
                return \App\Http\Controllers\api\ApiController::error(404,"path not found");
            }
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return \App\Http\Controllers\api\ApiController::error(403,"access denied");
            }
        });

        $this->renderable(function (ServiceUnavailableHttpException $e, $request) {
            if ($request->is('api/*')) {
                return \App\Http\Controllers\api\ApiController::error(503,"server side problem");
            }
        });

        $this->renderable(function (ValidationException $e , $request) {
            if ($request->is('api/*')) {
                return \App\Http\Controllers\api\ApiController::error(406,$e->errors());
            }
        });

        $this->renderable(function (UnprocessableEntityHttpException $e , $request) {
            if ($request->is('api/*')) {
                return \App\Http\Controllers\api\ApiController::error(422,"database insertion failed");
            }
        });

    }
}
