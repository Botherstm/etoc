<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }
      public function render($request, Throwable $exception)
    {
        if ($exception instanceof QueryException && $exception->getCode() === '23000') {
            $errorMessage = $exception->getMessage();
            if (strpos($errorMessage, 'posts_judul_unique') !== false) {
                // Menangani kesalahan Duplicate entry for key 'posts_judul_unique'
                return redirect()->back()->withInput()->withErrors([
                    'judul' => 'Judul telah digunakan sebelumnya.'
                ]);
            }
        }

        return parent::render($request, $exception);
    }
}
