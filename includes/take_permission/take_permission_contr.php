<?php

declare(strict_types= 1);

// empty input
function empty_input(string $permission, string $duration)
{
    if (empty($permission) || empty($duration)) {
        return true;
    } else {
        return false;
    }
    
}

// must fill other reason if other selected
function other_selected(string $permission, string $other_reason)
{
    if ($permission === "other" && empty($other_reason)) {
        return true;
    } else {
        return false;
    }
    
}