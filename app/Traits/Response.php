<?php
namespace App\Traits;

trait Response {
    function createResponse($status, $message, $data = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ]);
    }
}
