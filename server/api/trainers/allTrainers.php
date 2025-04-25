<?php
require_once __DIR__ . "/../../global.php" ;

// Get All Trainers From Database
require_once __DIR__ . "/../../database/queriesTrainers/allTrainers.php" ;
$trainers = allTrainers($pdo) ;
if($trainers[0]){
    echo json_encode(["status" => "success" , "trainers" => $trainers[1]]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $trainers[1]]) ;