<?php
require_once __DIR__ . "/../../cors.php" ;
require_once __DIR__ . "/../authentication/checkToken.php" ;
require_once __DIR__ . "/../../database/connection.php" ;

$headers = getallheaders() ;
$user = checkToken($headers) ;
if($user == "Invalid token"){
    echo json_encode(["status" => "error" , "error" => $user]);
    die() ;
}

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