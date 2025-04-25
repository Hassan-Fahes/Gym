<?php 
function checkStafId($pdo , $staf_id){
    try{
        $sql = "SELECT * FROM users WHERE id = :staf_id AND is_deleted = 0" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":staf_id" , $staf_id) ;
        $stmt->execute() ;
        $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
        if($user){
            return $user ;
        }
        return false ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}