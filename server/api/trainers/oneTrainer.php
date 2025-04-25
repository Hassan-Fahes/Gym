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
    // Get The trainer
    require_once __DIR__ . "/../../database/queriesTrainers/oneTrainer.php" ;
    $trainer = oneTrainer($pdo , $trainer_id) ;
    if($trainer[0]){
        echo json_encode(["status" => "success" , "trainer" => $trainer[1]]);
        die();
    }
    echo json_encode(["status" => "error" , "error" => $trainer[1]]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error_id"]) ;
}