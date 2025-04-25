<?php
require_once __DIR__ . "/../../global.php" ;

// Get All Appointments
require_once __DIR__ . "/../../database/queriesAppointments/allAppointments.php" ;
$appointments = allAppointments($pdo) ;
if($appointments[0]){
    echo json_encode(["status" => "success" , "appointments" => $appointments[1]]) ;
    die() ;
}
echo json_encode(["status" => "error" , "error" => $appointments[1]]) ;