<?php

namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait HttpResponse
{
    public function success(string $message = '', array $data = [], int $status_code = Response::HTTP_OK): JsonResponse
    {
        $responseData = [
            'success' => true
        ];

        if (!empty($message)) {
            $responseData['message'] = $message;
        }

        if (!empty($data)) {
            $responseData['data'] = $data;
        }

        return response()->json($responseData, $status_code);
    }

    public function error(string $message = '', int $status_code = Response::HTTP_OK): JsonResponse
    {
        $responseData = [
            'success' => false,
            'message' => $message,
        ];

        return response()->json($responseData, $status_code);
    }
}
