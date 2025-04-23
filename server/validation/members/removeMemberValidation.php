<?php
function removeMemberValidation($pdo , $member_id) {
    // Check if is the member_id is in Database
    require_once __DIR__ . "/../../database/queriesMembers/checkMemberId.php" ;
    $member = checkMemberId($pdo , $member_id) ;
    if($member[0]) {
        return $member ;
    }
    return false ;
}