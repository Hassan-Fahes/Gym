<?php
require_once __DIR__ . "/../../global.php" ;

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;
$account_name = htmlspecialchars(trim($data["account_name"] ?? "")) ;

// Validate Input 
require_once __DIR__ . "/../../validation/accounts/addAccountValidation.php" ;
$errors = addAccountValidation($account_name) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

// Inser To Database 
require_once __DIR__ . "/../../database/queriesAccounts/addAccount.php" ;
$response_from_databse = addAccount($pdo , $account_name , $user->id) ;
if($response_from_databse == "Add Account Successfuly"){
    echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;