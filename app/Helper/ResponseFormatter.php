<?php

namespace App\Helper;

class ResponseFormatter
{
    public static function success($message, $data = [])
    {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function error($code = 500, $message, $data = [], $resp_code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $resp_code);
    }
}
