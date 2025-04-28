<?php 
function checkClasseId($pdo , $classe_id){
    try{
        $sql = "SELECT * FROM classes WHERE id = :classe_id AND is_deleted = 0" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":classe_id" , $classe_id) ;
        $stmt->execute() ;
        $classe = $stmt->fetch(PDO::FETCH_ASSOC) ;
        if($classe){
            return $classe ;
        }
        return false ;
    }catch(PDOException $e){
        return false ;
    }
}