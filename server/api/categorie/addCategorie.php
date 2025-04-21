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
$categorie_name = htmlspecialchars(trim($data["categorie_name"] ?? "")) ;
$cost = htmlspecialchars(trim($data["cost"] ?? "")) ;

// Validation Input
require_once __DIR__ . "/../../validation/categorie/addCategorieValidation.php" ;
$errors = addCategorieValidation($categorie_name , $cost) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

// Insert To Databases 
require_once __DIR__ . "/../../database/queriesCategorie/addCategorie.php" ;
$response_from_databse = addCategorie($pdo , $categorie_name , $cost , $user->id) ;
if($response_from_databse == "Add Categorie Successfuly") {
    echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;