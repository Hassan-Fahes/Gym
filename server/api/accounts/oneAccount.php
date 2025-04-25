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
    // Get The Account
    require_once __DIR__ . "/../../database/queriesAccounts/oneAccount.php" ;
    $account = oneAccount($pdo , $account_id) ;
    if($account[0]){
        echo json_encode(["status" => "success" , "account" => $account[1]]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $account[1]]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}