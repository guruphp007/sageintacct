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
}