<?php
function updateAccount($pdo , $account_name , $account_id , $created_by) {
    try{
        $sql = "UPDATE accounts SET account_name = :account_name WHERE id = :account_id" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":account_name" , $account_name) ;
        $stmt->bindParam(":account_id" , $account_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php";
        $responseLogs = logs($pdo,$created_by , "Update a Account") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Update Account Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}