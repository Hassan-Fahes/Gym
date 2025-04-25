<?php 
function checkMemberId($pdo , $member_id){
    try{
        $sql = "SELECT * FROM members WHERE id = :member_id AND is_deleted = 0" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":member_id" , $member_id) ;
        $stmt->execute() ;
        $member = $stmt->fetch(PDO::FETCH_ASSOC) ;
        if($member){
            return [true , $member] ;
        }
        return [false] ;
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}