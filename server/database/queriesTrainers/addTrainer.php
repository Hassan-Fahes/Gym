<?php
function addTrainer($pdo , $full_name ,$contact , $created_by) {
    try{
        $sql = "INSERT INTO trainers (full_name , contact , created_by) VALUES(:full_name , :contact , :created_by) ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":full_name" , $full_name) ;
        $stmt->bindParam(":contact" , $contact) ;
        $stmt->bindParam(":created_by" , $created_by) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Add a new Trainer") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Add Trainer Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException){
        return $e->getMessage() ;
    }
}