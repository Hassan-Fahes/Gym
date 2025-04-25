<?php
require_once __DIR__ . "/../../global.php" ;
// Select members from Database 
require_once __DIR__ . "/../../database/queriesMembers/allMembers.php" ;
$members = allMembers($pdo) ;
if($members[0]){
    echo json_encode(["status" => "success" , "members" => $members[1]]);
    die() ;
}
echo json_encode(["status" => "error" , "error" => $members[1]]) ;