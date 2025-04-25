<?php
require_once __DIR__ . "/../../global.php" ;

// get json Data 
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$trainer_id = htmlspecialchars(trim($data["trainer_id"] ?? "")) ;

// Validate Input
require_once __DIR__ . "/../../validation/trainers/removeTrainerValidation.php" ;
$trainer = removeTrainerValidation($pdo , $trainer_id) ;
if($trainer){
    // Remove The trainer 
    require_once __DIR__ . "/../../database/queriesTrainers/removeTrainer.php" ;
    $response_from_databse = removeTrainer($pdo , $trainer_id , $user->id) ;
    if($response_from_databse == "Remove Trainer Successfuly"){
        echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
        die();
    }
    echo json_encode(["status" => "error" , "error" => $e]) ;

}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}