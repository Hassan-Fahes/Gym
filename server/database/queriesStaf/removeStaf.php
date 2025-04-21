<?php 
function removeStaf($pdo ,$staf_id , $created_by) {
    try{
        $sql = "UPDATE `users` SET `is_deleted` = '1' WHERE `users`.`id` = :staf_id; " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":staf_id" , $staf_id) ;
        $stmt->execute() ;
        require_once __DIR__ . "/../queriesLogs/logs.php" ;
        $responseLogs = logs($pdo,$created_by , "Remove a Staf") ;
        if($responseLogs == "Add Logs Successfuly"){
            return "Remove Staf Successfuly" ;
        }else{
            return $responseLogs ;
        }
    }catch(PDOException $e){
        return $e ;
    }
}