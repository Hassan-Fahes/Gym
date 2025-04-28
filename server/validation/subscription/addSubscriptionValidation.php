<?php

function addSubscriptionValidation($note , $month , $paid){
    $errors = [] ;
     // 1) Month: must be an integer
     if (filter_var($month, FILTER_VALIDATE_INT) === false) {
        $errors['month'] = 'Month must be an integer.';
    }

    // 2) Paid: must be a valid number (integer or float)
    if (!is_numeric($paid)) {
        $errors['paid'] = 'Paid must be a valid number.';
    }

    // 3) Note: length between 5 and (TEXT capacity − 1)
    $note = trim($note);
    $len  = mb_strlen($note);
    if ($len < 5 || $len > 65534) {
        $errors['note'] = 'Note must be between 5 and 65534 characters long.';
    }
    
    return $errors ;
}