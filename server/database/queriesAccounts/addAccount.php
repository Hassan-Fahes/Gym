<?php
function addAccount($pdo , $account_name , $created_by) {
    try{
        $sql = "INSERT INTO accounts (`account_name` , `created_by`) VALUES(:account_name ,
        :created_by) ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":account_name" , $account_name) ;
        $stmt->bindParam(":created_by" , $created_by) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Add a new Account") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Add Account Successfuly" ;
        }
        return $responseLogs ;    
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}