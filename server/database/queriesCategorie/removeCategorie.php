<?php
function removeCategorie($pdo , $categorie_id , $created_by) {
    try{
        $sql = "UPDATE `categories` SET `is_deleted` = '1' WHERE `categories`.`id` = :categorie_id; " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":categorie_id" , $categorie_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Remove a Categorie") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Remove Categorie Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e ;
    }
}