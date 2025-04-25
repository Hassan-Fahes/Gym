<?php 
function addAccountValidation($account_name) {
    $errors = [] ;
    // 1) Account Name: length between 3 and 150
    if (mb_strlen($account_name) < 3 || mb_strlen($account_name) > 150) {
        $errors['account_name'] = 'Account Name must be between 4 and 150 characters long.';
    }

    return $errors ;
}