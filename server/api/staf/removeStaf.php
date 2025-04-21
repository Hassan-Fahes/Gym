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
    // Remove The Staf from database 
    require_once __DIR__ . "/../../database/queriesStaf/removeStaf.php" ;
    $response_from_databse = removeStaf($pdo ,$staf_id , $user->id) ;
    if($response_from_databse == "Remove Staf Successfuly"){
        echo json_encode(["status" => "success" , "message" => $response_from_databse ]);
        die();
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
    die();
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}