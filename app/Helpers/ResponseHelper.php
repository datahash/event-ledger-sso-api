<?php

namespace App\Helpers;


class ResponseHelper
{
    public static function coreResponse($message, $data, $statusCode, $isSuccess = true)
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if($isSuccess) {
            return response()->json([
                'message' => $message,
                'status' => 'success',
                'code' => $statusCode,
                'results' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'status' => 'error',
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    public static function success($message, $data, $statusCode = 200)
    {
        return ResponseHelper::coreResponse($message, $data, $statusCode);
    }

    public static function error($message, $statusCode = 500)
    {
        if ($statusCode == 0 || $statusCode > 500)
        {
            $statusCode = 500;
        }
        return ResponseHelper::coreResponse($message, null, $statusCode, false);
    }
}
