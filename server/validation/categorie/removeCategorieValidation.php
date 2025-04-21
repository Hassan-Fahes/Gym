<?php
function removeCategorieValidation($pdo , $categorie_id){
    // Check if is the staf_id is in Database
    require_once __DIR__ . "/../../database/queriesCategorie/checkCategorieId.php" ;
    $user = checkCategorieId($pdo , $categorie_id) ;
    if($user) {
        return $user ;
    }
    return false ;
}