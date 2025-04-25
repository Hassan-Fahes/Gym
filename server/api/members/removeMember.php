<?php
require_once __DIR__ . "/../../global.php" ;

// get json Data 
$rawData = file_get_contents("php://input") ;

// transform json to array
$data = json_decode($rawData , true) ;

$member_id = htmlspecialchars(trim($data["member_id"] ?? "")) ;

// Validate Input 
require_once __DIR__ . "/../../validation/members/removeMemberValidation.php" ;
$true = removeMemberValidation($pdo , $member_id) ;
if($true){
    // Remove The Member from database
    require_once __DIR__ . "/../../database/queriesMembers/removeMember.php" ;
    $response_from_databse = removeMember($pdo , $member_id , $user->id) ;
    if($response_from_databse == "Remove Member Successfuly"){
        echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
    die(); 
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}