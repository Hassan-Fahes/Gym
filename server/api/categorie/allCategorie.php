<?php
require_once __DIR__ . "/../../global.php" ;

// Select all categories from database
require_once __DIR__ . "/../../database/queriesCategorie/allCategorie.php" ;
$categories = allCategories($pdo) ;
if($categories[0]){
    echo json_encode(["status" => "success" , "categories" => $categories[1]]) ;
    die() ;
}else{
    echo json_encode(["status" => "success" , "categories" => $categories[1]]) ;
    die() ;
}