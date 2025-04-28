<?php 
require_once __DIR__ . "/../../global.php" ;

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;
$title = htmlspecialchars(trim($data["title"] ?? "" )) ;
$start_date = htmlspecialchars(trim($data["start_date"] ?? "" )) ;
$end_date = htmlspecialchars(trim($data["end_date"] ?? "" )) ;
$color = htmlspecialchars(trim($data["color"] ?? "" )) ;
$trainer_id = htmlspecialchars(trim($data["trainer_id"] ?? "" )) ;

// Validate Inputs
require_once __DIR__ . "/../../validation/classes/addClassesValidation.php" ;
$errors = addClassesValidation($title , $start_date , $end_date , $color) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}
require_once __DIR__ . "/../../validation/trainers/removeTrainerValidation.php" ;
$true = removeTrainerValidation($pdo , $trainer_id) ;
if($true){
    // Insert classe to database
    require_once __DIR__ . "/../../database/queriesClasses/addClasse.php" ;
    $response_from_databse = addClasse($pdo , $title , $start_date , $end_date , $color , $trainer_id , $user->id) ;
    if($response_from_databse == "Add Classe Successfuly") {
        echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
    
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}