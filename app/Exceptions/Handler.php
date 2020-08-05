<?php

namespace App\Exceptions;

use App\Http\Responses\JsonResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        /*
        400 - BadRequest
        401 - Unauthorized
        403 - Forbidden
        404 - NotFound
        405 - MethodNotAllowed
        500 - InternalServerError
        */

        $class = get_class($exception);
        $diagonal_index = strrpos($class, '\\');
        $diagonal_index += $diagonal_index ? 1 : 0;
        $class = substr($class, $diagonal_index);
        $code = 500;

        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
        } else {
            $code = 500;
            $class = $class === 'Error' ? 'InternalServerError' : $class;
            // Log::error($exception->getTraceAsString());
            Log::error($exception->getMessage());
        }

        return JsonResponse::error(['application_error' => $class], $code);
    }
}
