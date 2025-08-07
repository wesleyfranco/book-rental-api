<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait HttpResponse
{
    public static function success(array $data = [], int $status_code = Response::HTTP_OK): JsonResponse
    {
        $responseData = [
            'success' => true,
            'data' => $data,
        ];

        return response()->json($responseData, $status_code);
    }

    public static function error(string $message = '', int $status_code = Response::HTTP_OK): JsonResponse
    {
        $responseData = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($responseData, $status_code);
    }
}
