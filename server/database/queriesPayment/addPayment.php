<?php
function addPayment($pdo , $paid , $member_id , $created_by , $message){
    try{
        $subscription = "subscription"; 
        $payment_date = date('Y-m-d') ;
        $sql = "INSERT INTO `payments` (`amount`, `payment_date`, `member_id`, `type`, `created_by`) 
        VALUES (:paid, :payment_date, :member_id, :subscription, :created_by) ; " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":paid" , $paid) ;
        $stmt->bindParam(":payment_date" , $payment_date) ;
        $stmt->bindParam(":member_id" , $member_id) ;
        $stmt->bindParam(":subscription" , $subscription) ;
        $stmt->bindParam(":created_by" , $created_by) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , $message) ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Add Payment Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
   
}