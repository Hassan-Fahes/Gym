<?php 
require_once __DIR__ . "/../../global.php" ;

// get json Data 
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$trainer_id = htmlspecialchars(trim($data["trainer_id"] ?? "")) ;
$full_name = htmlspecialchars(trim($data["full_name"] ?? "")) ;
$contact = htmlspecialchars(trim($data["contact"] ?? "")) ;

// Validate Input
require_once __DIR__ . "/../../validation/trainers/addTrainerValidation.php" ;
$errors = addTrainerValidation($full_name , $contact) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

// Validate Input
require_once __DIR__ . "/../../validation/trainers/removeTrainerValidation.php" ;
$trainer = removeTrainerValidation($pdo , $trainer_id) ;
if($trainer){
    // Update The Trainer
    require_once __DIR__ . "/../../database/queriesTrainers/updateTrainer.php" ;
    $response_from_databse = updateTrainer($pdo , $full_name , $contact , $trainer_id,$user->id) ;
    if($response_from_databse == "Update Trainer Successfuly") {
        echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}