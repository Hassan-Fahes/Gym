<?php 
function updateCategorie($pdo , $categorie_name , $cost , $categorie_id , $created_by) {
    try{
        $sql = "UPDATE `categories` SET categorie_name = :categorie_name , cost = :cost 
        WHERE id = :categorie_id ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":categorie_name" , $categorie_name) ;
        $stmt->bindParam(":cost" , $cost) ;
        $stmt->bindParam(":categorie_id" , $categorie_id) ;
        $stmt->execute();
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Update Categorie") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Updated Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e ;
    }
}