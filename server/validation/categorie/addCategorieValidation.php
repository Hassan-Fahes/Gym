<?php 
function addCategorieValidation($categorie_name , $cost) {
    $errors = [];

    // 1) Categorie: letters and spaces only, length between 3 and 150
    if (!preg_match('/^[\p{L}\s]+$/u', $categorie_name)) {
        $errors['categorie_name'] = 'Categorie must contain only letters and spaces.';
    } elseif (mb_strlen($categorie_name) < 3 || mb_strlen($categorie_name) > 150) {
        $errors['categorie_name'] = 'Categorie must be between 3 and 150 characters long.';
    }

    // 2) Cost: must be a number, can contain decimal point and must be positive
    if (!is_numeric($cost) || $cost <= 0) {
        $errors['cost'] = 'Cost must be a positive number.';
    }

    return $errors;

}