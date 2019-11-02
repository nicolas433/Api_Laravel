<?php

namespace App\API;

class ApiError
{
    public static function errorMessage($message, $code)
    {
        return [
            'msg' => $message,
            'code' => $code
        ];
    }
    
}
