<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;
use Exception;

class Controller extends BaseController
{
    /**
     * @param Exception $exception
     * @param string $callee
     */
    protected function log(Exception $exception, string $callee): void {
        Log::error($exception->getTraceAsString(), [ $callee ]);
    }
}
