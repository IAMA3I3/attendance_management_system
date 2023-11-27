<?php

declare(strict_types=1);

// empty input
function empty_input(string $current_pwd, string $new_pwd, string $confirm_pwd)
{
    if (empty($current_pwd) || empty($new_pwd) || empty($confirm_pwd)) {
        return true;
    } else {
        return false;
    }
    
}

// incorrect password
function incorrect_pwd(string $current_pwd, string $hashed_pwd)
{
    if (!password_verify($current_pwd, $hashed_pwd)) {
        return true;
    } else {
        return false;
    }
    
}

// password too short
function is_short(string $new_pwd)
{
    if (strlen($new_pwd) < 4) {
        return true;
    } else {
        return false;
    }
    
}

// new password and confirm password must be a match
function no_match(string $new_pwd, string $confirm_pwd)
{
    if ($new_pwd !== $confirm_pwd) {
        return true;
    } else {
        return false;
    }
    
}