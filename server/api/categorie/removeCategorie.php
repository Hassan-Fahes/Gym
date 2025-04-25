<?php
require_once __DIR__ . "/../../global.php" ;
// get json Data
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$categorie_id = htmlspecialchars(trim($data["categorie_id"] ?? "")) ;

// Validation Input
require_once __DIR__ . "/../../validation/categorie/removeCategorieValidation.php" ;
$true = removeCategorieValidation($pdo , $categorie_id) ;
if($true) {
    // Remove Categorie From Database
    require_once __DIR__ . "/../../database/queriesCategorie/removeCategorie.php" ;
    $response_from_databse = removeCategorie($pdo , $categorie_id , $user->id) ;
    if($response_from_databse == "Remove Categorie Successfuly"){
        echo json_encode(["status" => "success" , "message" => $response_from_databse ]);
        die();
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
    die();
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}