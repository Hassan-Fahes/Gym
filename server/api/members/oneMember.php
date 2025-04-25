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
    // Get This Member
    require_once __DIR__ . "/../../database/queriesMembers/oneMember.php" ;
    $member = oneMember($pdo , $member_id) ;
    if($member[0]){
        echo json_encode(["status" => "success" , "member" => $member[1]]);
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $member[1]]);
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}