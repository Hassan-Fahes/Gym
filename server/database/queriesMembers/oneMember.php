<?php 
function oneMember($pdo , $member_id) {
    try{
        $sql = "SELECT * FROM members Where id = :member_id AND is_deleted = 0"  ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":member_id" , $member_id) ;
        $stmt->execute() ;
        $member = $stmt->fetch(PDO::FETCH_ASSOC) ;
        return [true , $member] ;
    }catch(PDOException $e){
        return  [false , $e->getMessage()] ;
    }
}