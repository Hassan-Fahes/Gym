<?php
require_once __DIR__ . "/../../cors.php";
require_once __DIR__ . "/../../../vendor/autoload.php" ;
// ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../../");
$dotenv->load();
// For Token
$key = $_ENV['JWT_SECRET'];

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// get json data
$rawData = file_get_contents("php://input");

// transform json to array
$data = json_decode($rawData , true) ;

$username = htmlspecialchars(trim($data["username"] ?? "")) ;
$password = htmlspecialchars(trim($data["password"] ?? ""));

// Validation Inputs
require_once __DIR__ . "/../../validation/auth/loginValidation.php" ;

$errors = validateLogin($username , $password) ;

if(!empty($errors)){
    echo json_encode(["status" => "error" , "errors" => $errors]);
    exit();
}

// Select From Database
require_once __DIR__ . "/../../database/queriesAuth/login.php";
$user = login($username , $password) ;

// Create a token
if($user){
    unset($user["password"]);
    $payload = [
        "iss" => "http://localhost", 
        "aud" => "http://localhost", 
        "iat" => time(),             
        "exp" => time() + (3600 * 24 * 7),        
        "user" => $user
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');
    echo json_encode(["status" => "success" , "user" => $user , "token" => $jwt]);
}else{
    echo json_encode(["status" => "error" , "message" => "Incorrect email or password"]);
}
    