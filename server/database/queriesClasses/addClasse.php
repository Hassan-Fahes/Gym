<?php
function addClasse($pdo , $title , $start_date , $end_date , $color , $trainer_id , $created_by) {
    try{
        $sql = "INSERT INTO classes(`title` , `start_date` , `end_date` , `color` , `trainer_id` , `created_by`) VALUES (:title , 
        :start_date , :end_date , :color , :trainer_id , :created_by ) ; " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":title" , $title) ;  
        $stmt->bindParam(":start_date" , $start_date) ;  
        $stmt->bindParam(":end_date" , $end_date) ;
        $stmt->bindParam(":color" , $color) ; 
        $stmt->bindParam(":trainer_id" , $trainer_id) ; 
        $stmt->bindParam(":created_by" , $created_by) ; 
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Add a new Classe") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Add Classe Successfuly" ;
        }
        return $responseLogs ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }  
}