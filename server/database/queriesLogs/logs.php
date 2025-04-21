<?php
function logs($pdo ,$user_id , $action_description){
    try{
        $sql = "INSERT INTO `logs` (`user_id`,`action_description`) VALUES (:user_id , :action_description);";
        $stmt = $pdo->prepare($sql)  ;
        $stmt->bindParam(":user_id" , $user_id) ;
        $stmt->bindParam(":action_description" , $action_description) ;
        $stmt->execute() ; 
        return "Add Logs Successfuly" ;
    }catch(PDOException $e){
        return $e ;
    }   
}