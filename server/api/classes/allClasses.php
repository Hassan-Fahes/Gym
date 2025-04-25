<?php
require_once __DIR__ . "/../../global.php" ;

// Get All Classes from database
require_once __DIR__ . "/../../database/queriesClasses/allClasses.php" ;
$classes = allClasses($pdo) ;
if($classes[0]){
    echo json_encode(["status" => "success" , "classes" => $classes[1]]);
    die() ;
}
echo json_encode(["status" => "error" , "error" => $classes[1]]);