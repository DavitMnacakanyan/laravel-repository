<?php

namespace JetBox\Repositories\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

abstract class BaseException extends Exception
{
    /**
     * Report Error Log File
     */
    public function reportError(): void
    {
        lLog($this->getMessage(), 'error', [
            'code' => $this->getCode(),
            'line' => $this->getLine(),
            'function' => $this->getTrace()[0]['function'],
            'file' => $this->getFile(),
            'type' => $this->getTrace()[0]['type'],
        ]);
    }

    /**
     * @param string|null $type
     * @return JsonResponse
     */
    public function responseError(string $type = null): JsonResponse
    {
        $errorResponse = [
            'status' => 'error',
            'message' => $this->getMessage(),
            'type' => $type
        ];
        $statusCode = $this->getCode();

        return response()->json($errorResponse, $statusCode);
    }
}
