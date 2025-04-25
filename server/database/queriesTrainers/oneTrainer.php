<?php 
function oneTrainer($pdo , $trainer_id) {
    try{
        $sql = "SELECT * FROM trainers Where id = :trainer_id AND is_deleted = 0"  ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":trainer_id" , $trainer_id) ;
        $stmt->execute() ;
        $trainer = $stmt->fetch(PDO::FETCH_ASSOC) ;
        return [true , $trainer] ;
    }catch(PDOException $e){
        return  [false , $e->getMessage()] ;
    }
}