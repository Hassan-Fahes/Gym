<?php
require_once __DIR__ . "/../../global.php" ;

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;

$categorie_id = htmlspecialchars(trim($data["categorie_id"] ?? "" ));
$member_id = htmlspecialchars(trim($data["member_id"] ?? "" ));
$month = htmlspecialchars(trim($data["month"] ?? "" ));
$note = htmlspecialchars(trim($data["note"] ?? "" ));
$subscription_id = htmlspecialchars(trim($data["subscription_id"] ?? "")) ;
$paid = 44 ;
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
        require_once __DIR__ . "/../../validation/subscription/removeSubscriptionValidation.php" ;
        $subscription = removeSubscriptionValidation($pdo , $subscription_id) ;
        if($subscription[0]){
            // Update the subscription
            require_once __DIR__ . "/../../database/queriesSubscription/updateSubscription.php" ;
            $response_from_databse = updateSubscription($pdo , $note , $month , $member_id , $categorie_id , $subscription_id , $user->id) ;
            if($response_from_databse == "Update Subscription Successfuly") {
                echo json_encode(["status" => "success" , "message" => $response_from_databse]) ;
                die() ;
            }
            echo json_encode(["status" => "error" , "error" => $response_from_databse]) ;
        }else{
            echo json_encode( ["status" => "error" , "error" => "error_id"]) ;
        }
    }else{
        echo json_encode( ["status" => "error" , "error" => "error_id"]) ;
    }
}else{
    echo json_encode( ["status" => "error" , "error" => "error_id"]) ;
}    