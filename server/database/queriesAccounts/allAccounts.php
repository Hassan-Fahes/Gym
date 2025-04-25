<?php
function allAccounts($pdo) {
    try{
        $sql = "SELECT * FROM accounts WHERE is_deleted = 0 " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute() ;  
        $accounts = $stmt->fetch(PDO::FETCH_ASSOC) ;
        if($accounts){
            return [true , $accounts] ;
        }     
        return [false , "Empty"] ;
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}