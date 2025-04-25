<?php
function updateMember($pdo , $full_name , $address , $contact , $member_id , $created_by) {
    try{
        $sql = "UPDATE members SET full_name = :full_name , address = :address , contact =:contact 
        WHERE id =:member_id ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":full_name" , $full_name) ;
        $stmt->bindParam(":address" , $address) ;
        $stmt->bindParam(":contact" , $contact) ;
        $stmt->bindParam(":member_id" , $member_id) ;
        $stmt->execute();
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Update Member") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Update Member Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}