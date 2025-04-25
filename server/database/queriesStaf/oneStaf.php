<?php 
function oneStaf($pdo , $staf_id) {
    try{
        $sql = "SELECT * FROM users Where id = :staf_id AND is_deleted = 0"  ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":staf_id" , $staf_id) ;
        $stmt->execute() ;
        $staf = $stmt->fetch(PDO::FETCH_ASSOC) ;
        return [true , $staf] ;
    }catch(PDOException $e){
        return  [false , $e->getMessage()] ;
    }
}