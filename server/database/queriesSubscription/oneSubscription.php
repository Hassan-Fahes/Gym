<?php
function oneSubscription($pdo , $subscription_id){
    try{
        $sql = "SELECT * FROM `subscriptions` JOIN members ON members.id = subscriptions.member_id JOIN categories ON categories.id = subscriptions.categorie_id
        WHERE subscriptions.id = :subscription_id" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":subscription_id" , $subscription_id) ;
        $stmt->execute() ;
        $subscription = $stmt->fetch(PDO::FETCH_ASSOC) ;
        return [true , $subscription] ;    
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}