<?php
require_once __DIR__ . "/../../global.php" ;

// get json Data 
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$classe_id = htmlspecialchars(trim($data["classe_id"] ?? "")) ;

// Validate Input
require_once __DIR__ . "/../../validation/classes/removeClassesValidation.php" ;
$classe = removeClassesValidation($pdo , $classe_id) ;
if($classe){
    // Remove this classe 
    require_once __DIR__ . "/../../database/queriesClasses/removeClasse.php" ;
    $response_from_databse = removeClasse($pdo , $classe_id , $user->id) ;
    if($response_from_databse == "Remove Classe Successfuly" ){
        echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}