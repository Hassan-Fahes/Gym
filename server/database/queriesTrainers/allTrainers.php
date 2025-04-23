<?php 
function allTrainers($pdo) {

    try{
        $sql = "SELECT * FROM trainers WHERE is_deleted = 0 ";
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute() ;
        $trainers = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
        if($trainers){
            return [true , $trainers] ;
        }
        return [false , "Empty"] ;
    }catch(PDOException $e){
        return $e ;
    }
}