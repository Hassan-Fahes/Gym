<?php
function removeMember($pdo , $member_id , $created_by) {
    try{
        $sql = "UPDATE members SET is_deleted = 1 WHERE id = :member_id ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":member_id" , $member_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Remove a Member") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Remove Member Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){}
    
}