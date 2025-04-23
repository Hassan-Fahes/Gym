<?php 
function oneCategorie($pdo , $categorie_id) {
    try{
        $sql = "SELECT * FROM categories Where id = :categorie_id AND is_deleted = 0"  ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":categorie_id" , $categorie_id) ;
        $stmt->execute() ;
        $categorie = $stmt->fetch(PDO::FETCH_ASSOC) ;
        return [true , $categorie] ;
    }catch(PDOException $e){
        return  [false , $e] ;
    }
}