<?php
function allSubscriptions($pdo) {
    try{
        $sql = "SELECT * FROM `subscriptions` JOIN members ON members.id = subscriptions.member_id JOIN categories ON categories.id = subscriptions.categorie_id WHERE subscriptions.is_deleted = 0" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute();
        $subscriptions =$stmt->fetchAll(PDO::FETCH_ASSOC) ;
        if($subscriptions){
            return [true , $subscriptions] ;
        }
        return [false , $subscriptions] ;
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}