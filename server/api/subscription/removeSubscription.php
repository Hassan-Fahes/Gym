<?php
require_once __DIR__ . "/../../global.php" ;

// get json Data 
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$subscription_id = htmlspecialchars(trim($data["subscription_id"] ?? "")) ;

// Validate Input 
require_once __DIR__ . "/../../validation/subscription/removeSubscriptionValidation.php" ;
$subscription = removeSubscriptionValidation($pdo , $subscription_id) ;
if($subscription[0]){
    // Remove Subscription from database 
    require_once __DIR__ . "/../../database/queriesSubscription/removeSubscription.php" ;
    $response_from_databse = removeSubscription($pdo , $subscription_id , $user->id) ;
    if($response_from_databse == "Remove Subscription Successfuly"){
        echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}