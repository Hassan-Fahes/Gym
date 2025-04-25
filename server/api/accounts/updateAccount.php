<?php
require_once __DIR__ . "/../../global.php" ;

// get json Data 
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$account_id = htmlspecialchars(trim($data["account_id"] ?? "")) ;
$account_name = htmlspecialchars(trim($data["account_name"] ?? "")) ;

// Validate Input 
require_once __DIR__ . "/../../validation/accounts/addAccountValidation.php" ;
$errors = addAccountValidation($account_name) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

require_once __DIR__ . "/../../validation/accounts/removeAccountValidation.php" ;
$account = removeAccountValidation($pdo , $account_id) ;
if($account){
    // Update The Account
    require_once __DIR__ . "/../../database/queriesAccounts/updateAccount.php" ;
    $response_from_databse = updateAccount($pdo , $account_name , $account_id , $user->id) ;
    if($response_from_databse == "Update Account Successfuly") {
        echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}