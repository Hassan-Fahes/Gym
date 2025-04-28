<?php
function removeClassesValidation($pdo , $classe_id) {
    // Check if the classe id is in database 
    require_once __DIR__ . "/../../database/queriesClasses/checkClasseId.php" ;
    $classe = checkClasseId($pdo , $classe_id) ;
    if($classe) {
        return $classe ;
    }
    return false ;
}