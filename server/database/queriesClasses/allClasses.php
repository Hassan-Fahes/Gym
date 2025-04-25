<?php
function allClasses($pdo){
    try{
        $sql = "SELECT * FROM `classes` JOIN trainers ON trainers.id = classes.trainer_id 
        WHERE classes.is_deleted = 0 " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute() ;
        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
        if($classes) {
            return [true , $classes] ;
        }
        return [false , "Empty"] ;
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}