<?php
function updateClasse($pdo , $title , $start_date , $end_date , $trainer_id , $classe_id , $created_by) {
    try{
        $sql = "UPDATE classes SET title = :title , start_date = :start_date , end_date = :end_date , 
        trainer_id = :trainer_id WHERE id = :classe_id ; " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":title" , $title) ; 
        $stmt->bindParam(":start_date" , $start_date) ; 
        $stmt->bindParam(":end_date" , $end_date) ; 
        $stmt->bindParam(":trainer_id" , $trainer_id) ; 
        $stmt->bindParam(":classe_id" , $classe_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Update a Classe") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Update Classe Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
     
}