<?php 
function checkSubscriptionId($pdo , $subscription_id){
    try{
        $sql = "SELECT * FROM subscriptions WHERE id = :subscription_id AND is_deleted = 0" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":subscription_id" , $subscription_id) ;
        $stmt->execute() ;
        $subscription = $stmt->fetch(PDO::FETCH_ASSOC) ;
        if($subscription){
            return [true , $subscription] ;
        }
        return [false , $subscription] ;
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}