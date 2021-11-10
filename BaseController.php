<?php

class BaseController {
    
    public function response($output)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($output);
        exit;
    }
}