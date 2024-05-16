<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class PatientNotFoundException extends Exception
{
    public function __construct(string $message = "Patient not found.", int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'mesagge' => $this->message,
            ], $this->code);
        }
    }
}
