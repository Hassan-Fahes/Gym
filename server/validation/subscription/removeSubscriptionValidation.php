<?php
function removeSubscriptionValidation($pdo , $subscription_id) {
    // Check if the id in the database
    require_once __DIR__ . "/../../database/queriesSubscription/checkSubscriptionId.php" ;
    $subscription = checkSubscriptionId($pdo , $subscription_id) ;
    return $subscription ;
}