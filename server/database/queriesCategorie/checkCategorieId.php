<?php
function checkCategorieId($pdo , $categorie_id){
    try{
        $sql = "SELECT * FROM categories WHERE id = :categorie_id" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":categorie_id" , $categorie_id) ;
        $stmt->execute() ;
        $user = $stmt->fetch(PDO::FETCH_ASSOC) ;
        if($user){
            return $user ;
        }
        return false ;
    }catch(PDOException $e){
        return $e ;
    }
}