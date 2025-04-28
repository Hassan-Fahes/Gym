<?php
require_once __DIR__ . "/../../global.php" ;

// get json data
$rawData = file_get_contents("php://input") ;

// transform json to array 
$data = json_decode($rawData , true) ;

$full_name = htmlspecialchars(trim($data["full_name"] ?? "" ));
$contact = htmlspecialchars(trim($data["contact"] ?? "" ));
$categorie_id = htmlspecialchars(trim($data["categorie_id"] ?? "" ));
$month = htmlspecialchars(trim($data["month"] ?? "" ));
$paid = htmlspecialchars(trim($data["paid"] ?? "" ));
$note = htmlspecialchars(trim($data["note"] ?? "" ));
$address = htmlspecialchars(trim($data["address"] ?? "" ));

// Validate Input Members 
require_once __DIR__ . "/../../validation/members/addMembersValidation.php" ;
$errors = addMembersValidation($full_name , $address , $contact , $month , $paid , $note) ;
if(!empty($errors)){
    echo json_encode(["status" => "error" , "error" => $errors]) ;
    die() ;
}

// Check if is the categorie id is on database
require_once __DIR__ . "/../../validation/categorie/removeCategorieValidation.php" ;
$true = removeCategorieValidation($pdo , $categorie_id) ;
if($true) {
    // Insert Member to Database 
    require_once __DIR__ . "/../../database/queriesMembers/addMembers.php" ;
    $response_from_databse_members = addMembers($pdo , $full_name , $address , $contact , $user->id) ;
    if($response_from_databse_members[1] == "Add Members Successfuly"){
        // Insert Subscription to Database
        require_once __DIR__ . "/../../database/queriesSubscription/addSubscription.php" ;
        $response_from_databse_subscription = addSubscription($pdo , $response_from_databse_members[0] , $categorie_id , $month , $note , $user->id) ;
        if($response_from_databse_subscription == "Add Subscription Successfuly"){
            // Insert Payment to Database
            require_once __DIR__ . "/../../database/queriesPayment/addPayment.php" ;
            $message = "Add a new members and Subscription and Payment" ;
            $response_from_databse_payment = addPayment($pdo , $paid , $response_from_databse_members[0] , $user->id , $message) ;
            if($response_from_databse_payment == "Add Payment Successfuly"){
                echo json_encode(["status" => "success" , "message" => $response_from_databse_members[1]]);
                die() ;
            }else{
                echo json_encode(["status" => "error" , "error" => $response_from_databse_payment]);
                die();
            }
        }else{
            echo json_encode(["status" => "error" , "error" => $response_from_databse_subscription]);
            die();
        }
    }else{
        echo json_encode(["status" => "error" , "error" => $response_from_databse_members]);
        die();
    }
}else{
    echo json_encode(["status" => "error" , "error" => "error id"]) ;
}