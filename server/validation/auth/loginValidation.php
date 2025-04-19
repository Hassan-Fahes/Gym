<?php 
function validateLogin($username , $password){
$errors = [] ;

    if(strlen($username) <= 3 || strlen($username)> 150){
        $errors["username"] = "Enter a valid username" ;
    }
    if(strlen($password) < 8 ){ 
        $errors["password"] = "Enter a valid password" ;
    } 
    
    return $errors ; 
}