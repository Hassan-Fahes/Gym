<?php
function addTrainerValidation($full_name , $contact) {
    $errors = [] ;
    
   // 1) Full Name: letters and spaces only, length between 4 and 150
    if (!preg_match('/^[\p{L}\s]+$/u', $full_name)) {
        $errors['full_name'] = 'Full name must contain only letters and spaces.';
    } elseif (mb_strlen($full_name) < 4 || mb_strlen($full_name) > 150) {
        $errors['full_name'] = 'Full name must be between 4 and 150 characters long.';
    }

    // 2) Contact: digits only, length between 8 and 30
    if (!preg_match('/^\d+$/', $contact)) {
        $errors['contact'] = 'Contact must contain digits only.';
    } elseif (mb_strlen($contact) < 8 || mb_strlen($contact) > 30) {
        $errors['contact'] = 'Contact number must be between 8 and 30 digits long.';
    }

    return $errors ;
}