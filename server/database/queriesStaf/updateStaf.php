<?php
function updateSatf($pdo , $full_name , $password , $address , $active , $contact , $role , $staf_id , $created_by) {
    try{
        if($password == "xcvbnm,;lkjhuipotuyehgbf647urnjduertu47dndje"){
            $sql = "UPDATE users SET full_name = :full_name , address = :address , contact = :contact , 
            role = :role , active = :active WHERE id = :staf_id ;" ;
            $stmt = $pdo->prepare($sql) ;
            $stmt->bindParam(":full_name" , $full_name) ;
            $stmt->bindParam(":address" , $address) ;
            $stmt->bindParam(":contact" , $contact) ;
            $stmt->bindParam(":role" , $role) ;
            $stmt->bindParam(":active" , $active) ;
            $stmt->bindParam(":staf_id" , $staf_id) ;
            $stmt->execute() ;
            require_once __DIR__ . "/../queriesLogs/logs.php" ;
            $responseLogs = logs($pdo,$created_by , "Update Staf") ;
            if($responseLogs == "Add Logs Successfuly"){
                return "Update Staf Successfuly" ;
            }
            return $responseLogs ;
        }
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET full_name = :full_name , password =:password  , address = :address , contact = :contact , 
        role = :role , active = :active WHERE id = :staf_id ;" ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":full_name" , $full_name) ;
        $stmt->bindParam(":password" , $password) ;
        $stmt->bindParam(":address" , $address) ;
        $stmt->bindParam(":contact" , $contact) ;
        $stmt->bindParam(":role" , $role) ;
        $stmt->bindParam(":active" , $active) ;
        $stmt->bindParam(":staf_id" , $staf_id) ;
        $stmt->execute() ;
        return "Update Staf Successfuly" ;
        
    }catch(PDOException $e){
        return $e ; 
    }
}