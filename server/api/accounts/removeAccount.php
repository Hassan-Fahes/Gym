<?php
require_once __DIR__ . "/../../global.php" ;

// get json Data 
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$account_id = htmlspecialchars(trim($data["account_id"] ?? "")) ;

// Validate Input 
require_once __DIR__ . "/../../validation/accounts/removeAccountValidation.php" ;
$account = removeAccountValidation($pdo , $account_id) ;
if($account){
    // Remove Account 
    require_once __DIR__ . "/../../database/queriesAccounts/removeAccount.php" ;
    $response_from_databse = removeAccount($pdo , $account_id , $user->id) ;
    if($response_from_databse == "Remove Account Successfuly") {
        echo json_encode(["status" => "success" , "message" => $response_from_databse] ) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}