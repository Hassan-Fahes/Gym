<?php
function removeStafValidation($pdo , $staf_id){
    // Check if is the staf_id is in Database
    require_once __DIR__ . "/../../database/queriesStaf/checkStafId.php" ;
    $user = checkStafId($pdo , $staf_id) ;
    if($user) {
        return $user ;
    }
    return false ;
}