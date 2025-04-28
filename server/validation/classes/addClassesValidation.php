<?php
function addClassesValidation($title , $start_date , $end_date , $color){
    $errors = [] ;
    // 1) Title: letters and spaces only, length between 3 and 150
    if (mb_strlen($title) < 3 || mb_strlen($title) > 39) {
        $errors['title'] = 'Title must be between 3 and 39 characters long.';
    }else if (!preg_match('/^[\p{L}\s]+$/u', $title)) {
        $errors['title'] = 'Title must contain only letters and spaces.';
    } 

    // 2) Start Date: must be a valid datetime
    $start = DateTime::createFromFormat('Y-m-d H:i:s', $start_date);
    if (!$start) {
        $errors['start_date'] = 'Start date must be in format YYYY-MM-DD HH:MM:SS.';
    }

    // 3) Last Date: must be a valid datetime and greater than start date
    $end = DateTime::createFromFormat('Y-m-d H:i:s', $end_date);
    if (!$end) {
        $errors['end_date'] = 'Last date must be in format YYYY-MM-DD HH:MM:SS.';
    }

    if ($start && $end && $end <= $start) {
        $errors['end_date'] = 'Last date must be greater than start date.';
    }

    // 4) Color: must be a valid hexadecimal color code
    if (!preg_match('/^#[0-9A-Fa-f]{6}$/', $color)) {
        $errors['color'] = 'Color must be a valid hexadecimal color code (e.g., #A1B2C3).';
    }

    return $errors;
}