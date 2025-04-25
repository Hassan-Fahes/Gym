<?php 
function removeTrainer($pdo , $trainer_id , $created_by) {
    try{
        $sql = "UPDATE trainers SET is_deleted = 1 WHERE id = :trainer_id" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":trainer_id" , $trainer_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php";
        $responseLogs = logs($pdo,$created_by , "Remove a Trainer") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Remove Trainer Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}