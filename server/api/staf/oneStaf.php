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

// get json Data 
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$staf_id = htmlspecialchars(trim($data["staf_id"] ?? "")) ;

// Validation Inputs
require_once __DIR__ . "/../../validation/staf/removeStafValidation.php" ;
$true = removeStafValidation($pdo , $staf_id) ;
if($true){
    // Get this Staf 
    require_once __DIR__ . "/../../database/queriesStaf/oneStaf.php" ;
    $staf = oneStaf($pdo , $staf_id) ;
    if($staf[0]){
        echo json_encode(["status" => "success" , "staf" => $staf[1]]);
        die();
    }
    echo json_encode(["status" => "error" , "error" => $staf[1]]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}