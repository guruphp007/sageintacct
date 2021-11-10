<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require "BaseController.php";
require "BaseModel.php";
require "Database.php";
require "config.php";

$server_path_info           =    $_SERVER['PATH_INFO'] ?? FALSE;		
$controller_name            =    'student';    
$controller_action_name     =	'index';

if($server_path_info)
{
    $url_path	 =	  trim($server_path_info, '/');    
    $arrUrlChunks    =    explode('/', $url_path);    
    $controller_name    =    trim($arrUrlChunks[0]);    
    $controller_action_name    =	'index';
    
    if(count($arrUrlChunks) > 1)
        $controller_action_name    =    trim($arrUrlChunks[1]);
}

require "controllers/{$controller_name}.php";
$controller     =   new $controller_name;
$controller->$controller_action_name();