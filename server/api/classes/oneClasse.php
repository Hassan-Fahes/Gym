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
    // Get the classe from database 
    require_once __DIR__ . "/../../database/queriesClasses/oneClasse.php" ;
    $classe = oneClasse($pdo , $classe_id) ;
    if($classe[0]){
        echo json_encode(["status" => "success" , "classe" => $classe[1]]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $classe[1]]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}