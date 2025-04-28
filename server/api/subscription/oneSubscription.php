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
    // get the subscription from database 
    require_once __DIR__ . "/../../database/queriesSubscription/oneSubscription.php" ;
    $subscription = oneSubscription($pdo , $subscription_id) ;
    if($subscription[0]){
        echo json_encode(["status" => "success" , "subscription" => $subscription[1]]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $subscription[1]]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}