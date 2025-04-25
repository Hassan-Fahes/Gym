<?php
function removeTrainerValidation($pdo , $trainer_id){
    // Check if the trainer id is in Database
    require_once __DIR__ . "/../../database/queriesTrainers/checkTrainerId.php" ;
    $trainer = checkTrainerId($pdo , $trainer_id) ;
    if($trainer) {
        return $trainer ;
    }
    return false ;
}