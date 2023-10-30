<?php

declare(strict_types=1);

// empty input
function empty_input(string $first_name, string $last_name, int $staff_id, $dob, $site, string $email, string $pwd, string $confirm_pwd)
{
    if (empty($first_name) || empty($last_name) || empty($staff_id) || empty($dob) || empty($site) || empty($email) || empty($pwd) || empty($confirm_pwd)) {
        return true;
    } else {
        return false;
    }
    
}

// name must be letters only
function not_alpha(string $name)
{
    if (!ctype_alpha($name)) {
        return true;
    } else {
        return false;
    }
    
}

// id number is registered
function id_registered(object $pdo, int $staff_id)
{
    // check if id number exist in db
    if (search_id($pdo, $staff_id)) {
        return true;
    } else {
        return false;
    }
}

// email is invalid
function invalid_email(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
    
}

// email is registered
function email_registered(object $pdo, string $email)
{
    // check if email exist in db
    if (search_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
    
}

// pwd is too short
function is_short(string $pwd)
{
    if (strlen($pwd) < 4) {
        return true;
    } else {
        return false;
    }
    
}

// pwd and confirm pwd must match
function no_match(string $pwd, string $confirm_pwd)
{
    if ($pwd !== $confirm_pwd) {
        return true;
    } else {
        return false;
    }
    
}