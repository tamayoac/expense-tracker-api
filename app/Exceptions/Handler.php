<?php

namespace App\Exceptions;

use App\Traits\ResponseHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseHandler;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (ValidationException $exception, $request) {
        
            $message = $exception->validator->getMessageBag();
          
            if ($request->wantsJson()) {
                return $this->errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            return redirect()->back()->withErrors($message);
        });
        $this->renderable(function (NotFoundHttpException $exception, $request) {
            if($request->wantsJson()) 
            {
                $code = $exception->getStatusCode();
                $message = Response::$statusTexts[$code];
                return $this->errorResponse($message, $code);
            }
            return parent::render($request, $exception);
          
        });
    }
}
