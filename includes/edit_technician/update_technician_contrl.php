<?php

declare(strict_types= 1);

// empty inputs
function empty_input(string $first_name, string $last_name, int $staff_id, $dob, string $site, string $email, string $status)
{
    if (empty($first_name) || empty($last_name) || empty($staff_id) || empty($dob) || empty($site) || empty($email) || empty($status)) {
        return true;
    } else {
        return false;
    }
    
}

// invalid email
function invalid_email(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }

}

// staff id taken exclude this
function staff_id_taken_by_other(object $pdo, int $staff_id, $technician_id)
{
    // check for staff id in db exclude this
    if (check_staff_id_by_other($pdo, $staff_id, $technician_id)) {
        return true;
    } else {
        return false;
    }
    
}

// email taken exclude this
function email_taken_by_other(object $pdo, string $email, $technician_id)
{
    // check for email in db exclude this
    if (check_email_by_other($pdo, $email, $technician_id)) {
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