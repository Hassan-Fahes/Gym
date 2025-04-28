<?php
function removeSubscription($pdo , $subscription_id , $created_by) {
    try{
        $sql = "UPDATE subscriptions SET is_deleted = 1 WHERE id = :subscription_id ; " ; 
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":subscription_id" , $subscription_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Remove a Subscription") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Remove Subscription Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}