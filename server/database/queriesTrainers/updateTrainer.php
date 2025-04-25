<?php
function updateTrainer($pdo , $full_name , $contact , $trainer_id , $created_by) {
    try{
        $sql = "UPDATE trainers SET full_name = :full_name , contact = :contact WHERE 
        id = :trainer_id" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":full_name" , $full_name) ;
        $stmt->bindParam(":contact" , $contact) ;
        $stmt->bindParam(":trainer_id" , $trainer_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php";
        $responseLogs = logs($pdo,$created_by , "Update a Trainer") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Update Trainer Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}