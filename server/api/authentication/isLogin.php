<?php
require __DIR__ ."/../../cors.php" ;
require_once __DIR__ ."/./checkToken.php" ;
$headers = getallheaders() ;
$user = checkToken($headers) ;
if($user == "Invalid token"){
    
    echo json_encode(["status" => "error" , "message" => $user]);
    die() ;
    
}else{
    
    echo json_encode(["status" => "success" , "user" => $user]);
}