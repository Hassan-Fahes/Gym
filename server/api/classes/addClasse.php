<?php 
require_once __DIR__ . "/../../global.php" ;

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;
$name = htmlspecialchars(trim($data["name"] ?? "" )) ;
$shedule = htmlspecialchars(trim($data["shedule"] ?? "" )) ;
$trainer_id = htmlspecialchars(trim($data["trainer_id"] ?? "" )) ;
$day = htmlspecialchars(trim($data["day"] ?? "" )) ;

// Validate Inputs