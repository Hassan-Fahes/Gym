<?php
function removeAccountValidation($pdo , $account_id) {
    // Check if the account id is in database
    require_once __DIR__ . "/../../database/queriesAccounts/checkAccountId.php" ;
    $account = checkAccountId($pdo , $account_id) ;
    if($account) {
        return $account ;
    }
    return false ;
}