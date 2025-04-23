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

// Select members from Database 
require_once __DIR__ . "/../../database/queriesMembers/allMembers.php" ;
$members = allMembers($pdo) ;
if($members[0]){
    echo json_encode(["status" => "success" , "members" => $members[1]]);
    die() ;
}
echo json_encode(["status" => "error" , "error" => $members[1]]) ;