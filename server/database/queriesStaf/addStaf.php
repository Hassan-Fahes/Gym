<?php
function addStaf($pdo , $full_name , $username , $password , $address , $active , $contact , $role , $created_by) {
    try{
        // Check if the username is already in database
        $sql = "SELECT `username` FROM users WHERE `username` = :username " ;
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":username" , $username) ;
        $stmt->execute() ;
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$user){
            $sql = "INSERT INTO `users` 
            (`full_name`, `username`, `password`, `address`, `contact`, `role`, 
            `created_by`, `active`) VALUES (:full_name , :username , :password , :address , 
            :contact , :role , :created_by , :active );";
            $password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare($sql) ;
            $stmt->bindParam(":full_name" , $full_name) ;
            $stmt->bindParam(":username" , $username) ;
            $stmt->bindParam(":password" , $password) ;
            $stmt->bindParam(":address" , $address) ;
            $stmt->bindParam(":contact" , $contact) ;
            $stmt->bindParam(":role", $role) ;
            $stmt->bindParam(":created_by" , $created_by) ;
            $stmt->bindParam(":active" , $active) ;
            $stmt->bindParam(":role" , $role) ;
            $stmt->execute() ;
            require_once __DIR__ . "/../queriesLogs/logs.php" ;
            $responseLogs = logs($pdo,$created_by , "Add a new Staff") ;
            if($responseLogs == "Add Logs Successfuly"){
                return "Add Staf Successfuly" ;
            }
            return $responseLogs ;
            
        }else{
            return "This Username is already used" ;
        }    
    }catch(PDOException $e){
        return $e ;
    }
    
}