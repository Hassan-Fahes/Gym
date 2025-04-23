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

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;

$full_name = htmlspecialchars(trim($data["full_name"] ?? "" ));
$contact = htmlspecialchars(trim($data["contact"] ?? "" ));
$address = htmlspecialchars(trim($data["address"] ?? "" ));
$member_id = htmlspecialchars(trim($data["member_id"] ?? ""));

// Validate Input 
require_once __DIR__ . "/../../validation/members/updateMemberValidation.php" ;
$errors = updateMembersValidation($full_name , $address , $contact) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

// Check if is the member id is in database
require_once __DIR__ . "/../../validation/members/removeMemberValidation.php" ;
$true = removeMemberValidation($pdo , $member_id) ;
if($true){
    // Update The Member
    require_once __DIR__ . "/../../database/queriesMembers/updateMember.php" ;
    $response_from_databse = updateMember($pdo , $full_name , $address , $contact , $member_id , $user->id) ;
    if($response_from_databse == "Update Member Successfuly"){
        echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
        die() ;
    }
    echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}