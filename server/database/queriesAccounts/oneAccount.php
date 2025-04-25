<?php 
function oneAccount($pdo , $account_id) {
    try{
        $sql = "SELECT * FROM accounts Where id = :account_id AND is_deleted = 0"  ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":account_id" , $account_id) ;
        $stmt->execute() ;
        $account = $stmt->fetch(PDO::FETCH_ASSOC) ;
        return [true , $account] ;
    }catch(PDOException $e){
        return  [false , $e->getMessage()] ;
    }
}