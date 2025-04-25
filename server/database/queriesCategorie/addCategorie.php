<?php 
function addCategorie($pdo , $categorie_name , $cost , $created_by) {
    try{
        $sql = "INSERT INTO categories (`categorie_name` , `cost` , `created_by`) VALUES(:categorie_name , :cost , :created_by) ;";
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":categorie_name" , $categorie_name) ;
        $stmt->bindParam(":cost" , $cost) ;
        $stmt->bindParam(":created_by" , $created_by) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Add a new Categorie") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Add Categorie Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }    
}