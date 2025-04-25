<?php 
function addMembers($pdo , $full_name , $address , $contact , $created_by){
    try{
        $sql = "INSERT INTO members (`full_name` , `address` , `contact` , `created_by`) VALUES(:full_name , 
        :address , :contact , :created_by) ;";
        $stmt = $pdo->prepare($sql) ;
        $stmt->bindParam(":full_name" , $full_name);
        $stmt->bindParam(":address" , $address);
        $stmt->bindParam(":contact" , $contact);
        $stmt->bindParam(":created_by" , $created_by);
        $stmt->execute() ;
        $member_id = $pdo->lastInsertId();
        return [$member_id , "Add Members Successfuly"] ;
    }catch(PDOException $e){
        return $e->getMessage() ;
    }
    
}