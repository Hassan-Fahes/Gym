<?php
require_once __DIR__ . "/../../global.php" ;

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;

$categorie_id = htmlspecialchars(trim($data["categorie_id"] ?? "" ));
$member_id = htmlspecialchars(trim($data["member_id"] ?? "" ));
$month = htmlspecialchars(trim($data["month"] ?? "" ));
$paid = htmlspecialchars(trim($data["paid"] ?? "" ));
$note = htmlspecialchars(trim($data["note"] ?? "" ));

// Validate Input
require_once __DIR__ . "/../../validation/subscription/addSubscriptionValidation.php" ;
$errors = addSubscriptionValidation($note , $month , $paid) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

require_once __DIR__ . "/../../validation/categorie/removeCategorieValidation.php" ;
$categorie = removeCategorieValidation($pdo , $categorie_id) ;
if($categorie){
    require_once __DIR__ . "/../../validation/members/removeMemberValidation.php" ;
    $member = removeMemberValidation($pdo , $member_id) ;
    if($member){
        // Add Subscription 
        require_once __DIR__ . "/../../database/queriesSubscription/addSubscription.php" ;
        $response_from_databse_subscription = addSubscription($pdo , $member_id , $categorie_id , $month , $note , $user->id) ;
        if($response_from_databse_subscription == "Add Subscription Successfuly"){
            require_once __DIR__ . "/../../database/queriesPayment/addPayment.php" ;
            $message = "Add a new subscription and payment" ;
            $response_from_databse_payment = addPayment($pdo , $paid , $member_id , $user->id , $message) ;
            if($response_from_databse_payment == "Add Payment Successfuly"){
                echo json_encode(["status" => "success" , "message" => $response_from_databse_subscription]);
                die();
            }
            echo json_encode( ["status" => "error" , "error" => $response_from_databse_payment]) ;
            die();
        }
        echo json_encode( ["status" => "error" , "error" => $response_from_databse_subscription]) ;
        die();
    }else{
        echo json_encode( ["status" => "error" , "error" => "error_id"]) ;
    }
}else{
    echo json_encode(["status" => "error" , "error" => "error_id"]) ;
}