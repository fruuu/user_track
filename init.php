<?php

header('Content-Type: text/html; charset=utf-8');

define("DB_USER", ""); 
define("DB_PASS", ""); 
define("DB_HOST", ""); 
define("DB_NAME", ""); 

$path = __DIR__."/";

define("PATH", $path."/");


spl_autoload_register(function($class){
    
    require_once (PATH .$class. '.php');
    
});