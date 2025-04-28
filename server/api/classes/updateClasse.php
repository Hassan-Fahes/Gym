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
$classe_id = htmlspecialchars(trim($data["classe_id"] ?? "" )) ;

// Validate Inputs
require_once __DIR__ . "/../../validation/classes/addClassesValidation.php" ;
$errors = addClassesValidation($title , $start_date , $end_date , $color) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

require_once __DIR__ . "/../../validation/classes/removeClassesValidation.php" ;
$classe = removeClassesValidation($pdo , $classe_id) ;
if($classe){
    require_once __DIR__ . "/../../validation/trainers/removeTrainerValidation.php" ;
    $true = removeTrainerValidation($pdo , $trainer_id) ;
    if($true){
        // Update The Classe 
        require_once __DIR__ . "/../../database/queriesClasses/updateClasse.php" ;
        $response_from_databse = updateClasse($pdo , $title , $start_date , $end_date , $trainer_id , $classe_id , $user->id) ;
        if($response_from_databse == "Update Classe Successfuly" ){
            echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
            die() ;
        }
        echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
    }else{
        echo json_encode(["status" => "error" , "error" => "error id"]) ;
    } 
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}