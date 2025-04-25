<?php
require_once __DIR__ . "/cors.php" ;
require_once __DIR__ . "/api/authentication/checkToken.php" ;
require_once __DIR__ . "/database/connection.php" ;

$headers = getallheaders() ;
$user = checkToken($headers) ;
if($user == "Invalid token"){
    echo json_encode(["status" => "error" , "error" => $user]);
    die() ;
}