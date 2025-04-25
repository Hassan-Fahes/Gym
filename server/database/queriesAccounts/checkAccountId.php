<?php
function checkAccountId($pdo , $account_id) {
    try{
        $sql = "SELECT * FROM accounts WHERE id = :account_id AND is_deleted = 0" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":account_id" , $account_id) ;
        $stmt->execute() ;
        $account = $stmt->fetch(PDO::FETCH_ASSOC) ;
        if($account){
            return $account ;
        }
        return false ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
}