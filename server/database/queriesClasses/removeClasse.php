<?php
function removeClasse($pdo , $classe_id , $created_by){
    try{
        $sql = "UPDATE classes SET is_deleted = 1 WHERE id = :classe_id ; " ; 
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":classe_id" , $classe_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Remove a Classe") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Remove Classe Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}