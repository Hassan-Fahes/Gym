<?php 
function checkTrainerId($pdo , $trainer_id) {
    try{
        $sql = "SELECT * FROM trainers WHERE id = :trainer_id AND is_deleted = 0 " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":trainer_id" , $trainer_id) ;
        $stmt->execute() ;
        $trainer = $stmt->fetch(PDO::FETCH_ASSOC) ;
        if($trainer){
            return $trainer ;
        }
        return false ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}