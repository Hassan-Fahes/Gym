<?php
require_once __DIR__ . "/../../global.php" ;

// Get All Accounts 
require_once __DIR__ . "/../../database/queriesAccounts/allAccounts.php" ;
$accounts = allAccounts($pdo) ;
if($accounts[0]){
    echo json_encode(["status" => "success" , "accounts" => $accounts[1]]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $accounts[1]]) ;