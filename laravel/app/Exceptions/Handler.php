<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        /**
         * SI un client HTTP intérroge l'API avec une méthode qui n'existe pas pour une route
         */
        if ($exception instanceof MethodNotAllowedHttpException && $request->acceptsJson()) {
            return response()->json([
                'status' => 'error',
                'data' => [
                    'message' => 'La méthode utilisée pour cette route n\'existe pas.'
                ]
            ], 405);
        }

        /**
         * SI un client HTTP intérroge l'API et que la ressource n'existe pas
         */
        if ($exception instanceof ModelNotFoundException && $request->acceptsJson()) {
            return response()->json([
                'status' => 'error',
                'data' => [
                    'message' => 'La ressource demandée n\'existe pas.'
                ]
            ], 404);
        }

        /**
         * SI un client HTTP intérroge l'API et que l'URL n'existe pas
         */
        if($exception instanceof NotFoundHttpException  && $request->acceptsJson() )
        {
            return response()->json([
                'status' => 'error',
                'data' => [
                    'message' => 'Cette route n\'existe pas.'
                ]
            ], 404);
        }

        /**
         * Exception Angular: Il n'existe qu'une seule route sur LARAVEL,
         * Elle permet d'afficher l'index d'ANGULAR. Donc lorsque une route
         * n'existe pas sur LARAVEL elle est redirigée automatiquement sur
         * l'index. Si il y a une "vraie" erreur alors ANGULAR s'occupe
         * d'afficher l'erreur
         */
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('index');
        }

        return parent::render($request, $exception);
    }
}
