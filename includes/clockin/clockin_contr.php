<?php

declare(strict_types=1);

// empty field
function empty_input(string $email, string $pwd)
{
    if (empty($email) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
    
}

// wrong email
function wrong_email(bool|array $result)
{
    if (!$result) {
        return true;
    } else {
        return false;
    }
    
    
}

// wrong password
function wrong_pwd(string $pwd, string $hashedPwd)
{
    if (!password_verify($pwd, $hashedPwd)) {
        return true;
    } else {
        return false;
    }
}

// already clocked in today
function clockedin_today(bool|array $day)
{
    if ($day) {
        return true;
    } else {
        return false;
    }
    
}