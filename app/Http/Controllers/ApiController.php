<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct()
    {
       $this->user = JWTAuth::parseToken()->authenticate();
    }
    
    protected function success($data=[], $message='success', $code=200)
    {
        return $this->result('success', $data, $message, $code);
    }


    protected function error($data=[], $message='error', $code=400)
    {
        return $this->result('error', $data, $message, $code);
    }

    
    /**
     * @param $status
     * @param array $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    
    protected function result($status, $data=[], $message='', $code=200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
