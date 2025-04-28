<?php
function oneClasse($pdo , $classe_id){
    try{
        $sql = "SELECT * FROM `classes` JOIN trainers ON trainers.id = classes.trainer_id WHERE classes.id = :classe_id ; " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":classe_id" , $classe_id) ;
        $stmt->execute() ;
        $classe = $stmt->fetch(PDO::FETCH_ASSOC) ;
        return [true , $classe] ;    
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}