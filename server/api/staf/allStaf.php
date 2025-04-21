<?php
require_once __DIR__ . "/../../cors.php" ;
require_once __DIR__ . "/../authentication/checkToken.php" ;
require_once __DIR__ . "/../../database/connection.php" ;

$headers = getallheaders() ;
$user = checkToken($headers) ;
if($user == "Invalid token"){
    echo json_encode(["status" => "error" , "error" => $user]);
    die() ;
}

// Select All Staf from Database
require_once __DIR__ . "/../../database/queriesStaf/allStaf.php" ;
$stafs = allStaf($pdo) ;
if($stafs[0]){
    echo json_encode(["status" => "success" , "stafs" => $stafs[1]]);
    die();
}else{
    echo json_encode(["status" => "error" , "error" => $stafs[1]]);
    die();
}