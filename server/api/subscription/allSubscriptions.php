<?php
require_once __DIR__ . "/../../global.php" ;

// Get all subscription from database
require_once __DIR__ . "/../../database/queriesSubscription/allSubscriptions.php" ;
$subscriptions = allSubscriptions($pdo) ;
if($subscriptions[0]){
    echo json_encode(["status" => "success" , "subscriptions" => $subscriptions[1]]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $subscriptions[1]]) ;