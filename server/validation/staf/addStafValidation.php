<?php
function addStafValidation($full_name , $username , $password , $address , $active , $contact ,$role) {
    $errors = [] ;
   // 1) Full Name: letters and spaces only, length between 4 and 150
    if (!preg_match('/^[\p{L}\s]+$/u', $full_name)) {
        $errors['full_name'] = 'Full name must contain only letters and spaces.';
    } elseif (mb_strlen($full_name) < 4 || mb_strlen($full_name) > 150) {
        $errors['full_name'] = 'Full name must be between 4 and 150 characters long.';
    }

    // 2) Username: length between 4 and 150
    if (mb_strlen($username) < 4 || mb_strlen($username) > 150) {
        $errors['username'] = 'Username must be between 4 and 150 characters long.';
    }

    // 3) Password: at least 8 characters
    if (mb_strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }

    // 4) Address: length between 4 and 70
    if (mb_strlen($address) < 4 || mb_strlen($address) > 70) {
        $errors['address'] = 'Address must be between 4 and 70 characters long.';
    }

    // 5) Active: must be "yes" or "no"
    if ($active !== 'yes' && $active !== 'no') {
        $errors['active'] = 'Active field must be either "yes" or "no".';
    }

    // 6) Contact: digits only, length between 8 and 30
    if (!preg_match('/^\d+$/', $contact)) {
        $errors['contact'] = 'Contact must contain digits only.';
    } elseif (mb_strlen($contact) < 8 || mb_strlen($contact) > 30) {
        $errors['contact'] = 'Contact number must be between 8 and 30 digits long.';
    }

    // 7) Role : integer between 1 and 3
    if($role != 1 && $role != 2 && $role != 3){
        $errors["role"] = "Role is error" ;
    }

    return $errors ;
}