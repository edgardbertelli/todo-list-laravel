<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnavailableLocaleException extends Exception
{
    public function report(): void
    {
        // ...
    }

    public function render(Request $request): Response
    {
        return response("I'm sorry, but this locale is not available", 400);
    }
}
