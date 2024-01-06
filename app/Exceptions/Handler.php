<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $e
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            // Log the exception details
            Log::error('ModelNotFoundException: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
        }

        parent::report($e);
    }
}
