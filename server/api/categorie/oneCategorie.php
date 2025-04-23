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

$categorie_id = htmlspecialchars(trim($data["categorie_id"] ?? "")) ;

// Validation Input
require_once __DIR__ . "/../../validation/categorie/removeCategorieValidation.php" ;
$true = removeCategorieValidation($pdo , $categorie_id) ;
if($true) {
    // Get This Categorie
    require_once __DIR__ . "/../../database/queriesCategorie/oneCategorie.php" ;
    $categorie = oneCategorie($pdo , $categorie_id) ;
    if($categorie[0]){
        echo json_encode(["status" => "success" , "categorie" => $categorie[1]]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $categorie[1]]) ; 
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}