<?php
function addSubscription($pdo , $member_id , $categorie_id , $month , $note , $created_by){
    try{
        $join_date = date('Y-m-d');
    
        // Expire Date = join_date + month 
        
        $dt = new DateTime($join_date);
        $dt->modify("+{$month} months");
        $expire_date = $dt->format('Y-m-d');
    
        $sql = "INSERT INTO `subscriptions` (`member_id`, `categorie_id`, `months`, `note`, `join_date`,
        `expire_date`, `created_by`) VALUES (:member_id, :categorie_id, :month, :note, :join_date, :expire_date, 
        :created_by) ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":member_id" , $member_id) ;
        $stmt->bindParam(":categorie_id" , $categorie_id) ;
        $stmt->bindParam(":month" , $month) ;
        $stmt->bindParam(":note" , $note) ;
        $stmt->bindParam(":join_date" , $join_date) ;
        $stmt->bindParam(":expire_date" , $expire_date) ;
        $stmt->bindParam(":created_by" , $created_by) ;
        $stmt->execute() ;
        return "Add Subscription Successfuly" ;
    }catch(PDOException $e){
        return $e ;
    }
   
}