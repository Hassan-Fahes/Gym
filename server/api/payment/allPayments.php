<?php
require_once __DIR__ . "/../../global.php" ;

// Get all Payments from database
require_once __DIR__ . "/../../database/queriesPayment/allPayments.php" ;
$payments = allPayments($pdo) ;
if($payments[0]){
    echo json_encode(["status" => "success" , "payments" => $payments[1]]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $payments[1]]) ;