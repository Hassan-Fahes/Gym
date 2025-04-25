<?php
function addMembersValidation($full_name , $address , $contact , $month , $paid , $note){
    $errors = [] ;
    // 1) Full Name: letters and spaces only, length between 4 and 150
    if (mb_strlen($full_name) < 4 || mb_strlen($full_name) > 150) {
        $errors['full_name'] = 'Full name must be between 4 and 150 characters long.';
    }else if (!preg_match('/^[\p{L}\s]+$/u', $full_name)) {
        $errors['full_name'] = 'Full name must contain only letters and spaces.';
    } 

    // 2) Address: length between 4 and 70
    if (mb_strlen($address) < 4 || mb_strlen($address) > 70) {
        $errors['address'] = 'Address must be between 4 and 70 characters long.';
    }

    // 3) Contact: digits only, length between 8 and 30
    if (!preg_match('/^\d+$/', $contact)) {
        $errors['contact'] = 'Contact must contain digits only.';
    } elseif (mb_strlen($contact) < 8 || mb_strlen($contact) > 30) {
        $errors['contact'] = 'Contact number must be between 8 and 30 digits long.';
    }

    // 4) Month: must be an integer
    if (filter_var($month, FILTER_VALIDATE_INT) === false) {
        $errors['month'] = 'Month must be an integer.';
    }

    // 5) Paid: must be a valid number (integer or float)
    if (!is_numeric($paid)) {
        $errors['paid'] = 'Paid must be a valid number.';
    }

    // 6) Note: length between 5 and (TEXT capacity − 1)
    $note = trim($note);
    $len  = mb_strlen($note);
    if ($len < 5 || $len > 65534) {
        $errors['note'] = 'Note must be between 5 and 65534 characters long.';
    }
    
    return $errors ;
}