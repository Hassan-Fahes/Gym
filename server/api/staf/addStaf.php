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
$full_name = htmlspecialchars(trim($data["full_name"] ?? ""));
$username = htmlspecialchars(trim($data["username"] ?? ""));
$password = htmlspecialchars(trim($data["password"] ?? ""));
$address = htmlspecialchars(trim($data["address"] ?? ""));
$active = htmlspecialchars(trim($data["active"] ?? ""));
$contact = htmlspecialchars(trim($data["contact"] ?? ""));
$role = htmlspecialchars(trim($data["role"] ?? ""));

// Validation Inputs
require_once __DIR__ . "/../../validation/staf/addStafValidation.php" ;
$errors = addStafValidation($full_name , $username , $password , $address , $active , $contact , $role) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

// Insert To Database 
require_once __DIR__ . "/../../database/queriesStaf/addStaf.php" ;
$response_from_databse = addStaf($pdo , $full_name , $username , $password , $address , $active , $contact, $role , $user->id) ;
if($response_from_databse == "Add Staf Successfuly") {
    echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;