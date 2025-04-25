<?php
function removeAccount($pdo , $account_id, $created_by) {
    try{
        $sql = "UPDATE `accounts` SET `is_deleted` = '1' WHERE `accounts`.`id` = :account_id; " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":account_id" , $account_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Remove a Account") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Remove Account Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}