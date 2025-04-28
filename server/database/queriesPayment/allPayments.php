<?php
function allPayments($pdo){
    try{
        $sql = "SELECT * FROM `payments` JOIN members ON members.id = payments.member_id WHERE payments.is_deleted = 0 ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute() ;
        $payments = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
        if($payments){
            return [true , $payments] ;
        }
        return [false , "Empty" ] ;    
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}