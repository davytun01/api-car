<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                $code = 500;
                $message = $e->getMessage() ?: 'Server Error';

                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    $code = 422;
                    $message = 'Validation Failed';
                    $data = $e->errors();
                } elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    $code = 401;
                    $message = 'Unauthenticated';
                } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                    $code = 404;
                    $message = 'Resource not found';
                } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                    $code = $e->getStatusCode();
                }

                $response = [
                    'success' => false,
                    'message' => $message,
                ];

                if (isset($data)) {
                    $response['data'] = $data;
                }

                return response()->json($response, $code);
            }
        });
    })->create();
