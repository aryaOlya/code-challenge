<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public static function success($data,$code=200,$message=null): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'status' => 'ok',
                'data' => $data,
                'message' => $message,
                'code' => $code
            ],
            $code
        );
    }
    public static function error($code=404,$message=null,$data=null): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'status' => 'error',
                'data' => $data,
                'message' => $message,
                'code' => $code,
            ],
            $code
        );
    }
}
