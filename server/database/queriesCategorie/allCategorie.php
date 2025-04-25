<?php
function allCategories($pdo){
    try{
        $sql = "SELECT * FROM `categories` WHERE is_deleted = 0" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->execute() ;
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC) ;
        if($categories){
            return [true , $categories] ;
        }
        return [false , "Empty"] ;
    }catch(PDOException $e){
        return [false , $e->getMessage()] ;
    }
}