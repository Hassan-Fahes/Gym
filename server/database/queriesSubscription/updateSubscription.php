<?php
function updateSubscription($pdo , $note , $month , $member_id , $categorie_id , $subscription_id ,$created_by) {
    try{
        $sql = "UPDATE subscriptions SET note = :note , months = :month , member_id = :member_id , 
        categorie_id = :categorie_id WHERE id = :subscription_id ; " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":note" , $note) ; 
        $stmt->bindParam(":month" , $month) ; 
        $stmt->bindParam(":member_id" , $member_id) ; 
        $stmt->bindParam(":categorie_id" , $categorie_id) ; 
        $stmt->bindParam(":subscription_id" , $subscription_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Update a Subscription") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Update Subscription Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
     
}