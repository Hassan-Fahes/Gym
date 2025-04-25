<?php
function allMembers($pdo) {
    try{
        $sql = "SELECT * FROM members WHERE is_deleted = 0 ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute() ;
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
        if($members){
            return [true , $members] ;
        }
        return [false , "Empty"] ;
    }catch(PDOException $e){
        return [false , $e->getMessage()] ; 
    }
}