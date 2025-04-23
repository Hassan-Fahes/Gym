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

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;
$full_name = htmlspecialchars(trim($data["full_name"] ?? "")) ;
$contact = htmlspecialchars(trim($data["contact"] ?? "")) ;

// Validate Input
require_once __DIR__ . "/../../validation/trainers/addTrainerValidation.php" ;
$errors = addTrainerValidation($full_name , $contact) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

// Insert Trainer To Database
require_once __DIR__ . "/../../database/queriesTrainers/addTrainer.php" ;
$response_from_databse = addTrainer($pdo , $full_name ,$contact , $user->id) ;
if($response_from_databse == "Add Trainer Successfuly"){
    echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;