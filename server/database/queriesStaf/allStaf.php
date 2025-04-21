<?php
function allStaf($pdo){
    try{
        $sql = "SELECT id , full_name , username , address , contact , role  FROM `users` WHERE role != -1" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute() ;
        $stafs = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
        if($stafs){
            return [true , $stafs] ;
        }else{
            return [false , "Empty"] ;
        }
    }catch(PDOException $e){
        return [false , $e] ;
    }
}