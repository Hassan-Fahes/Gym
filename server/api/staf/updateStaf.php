<?php
require_once __DIR__ . "/../../global.php" ;

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;
$full_name = htmlspecialchars(trim($data["full_name"] ?? ""));
$password = htmlspecialchars(trim($data["password"] ?? ""));
$address = htmlspecialchars(trim($data["address"] ?? ""));
$active = htmlspecialchars(trim($data["active"] ?? ""));
$contact = htmlspecialchars(trim($data["contact"] ?? ""));
$role = htmlspecialchars(trim($data["role"] ?? ""));
$staf_id = htmlspecialchars(trim($data["staf_id"] ?? "")) ;
$username = "hassan" ;
if($password == "") {
    $password = "xcvbnm,;lkjhuipotuyehgbf647urnjduertu47dndje" ;    
}

// Validation Inputs
require_once __DIR__ . "/../../validation/staf/addStafValidation.php" ;
$errors = addStafValidation($full_name , $username , $password ,$address , $active , $contact , $role) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}
require_once __DIR__ . "/../../validation/staf/removeStafValidation.php" ;
$true = removeStafValidation($pdo , $staf_id) ;
if($true){
    // Update Staf
    require_once __DIR__ . "/../../database/queriesStaf/updateStaf.php" ;
    $response_from_databse = updateSatf($pdo , $full_name , $password , $address , $active , $contact , $role , $staf_id , $user->id) ;
    if($response_from_databse == "Update Staf Successfuly"){
        echo json_encode(["status" => "success" , "message" => $response_from_databse]);
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]); 
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}