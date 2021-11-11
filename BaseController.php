<?php

class BaseController {
    
    public function successResponse($payload, $code = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        $arrResponse = [
            'success' => true,
            'code' => $code,
            'payload' => $payload                
        ];
        echo json_encode($arrResponse);
        exit;
    }

    public function errorResponse($message, $code = 500)
    {
        header('Content-Type: application/json; charset=utf-8');
        $arrResponse = [
            'success' => false,
            'code' => $code,
            'error' => $message                
        ];
        echo json_encode($arrResponse);
        exit;
    }
}