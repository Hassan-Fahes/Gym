<?php
function allAppointments($pdo){
    try{
        $sql = "SELECT * FROM appointments WHERE is_deleted = 0 " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute() ;
        $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
        if($appointments){
            return [true , $appointments] ;
        }
        return [false , "Empty"] ;
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}