<?php

declare(strict_types=1);

// empty input
function empty_input(string $title, string $description)
{
    if (empty($title) || empty($description)) {
        return true;
    } else {
        return false;
    }
    
}

// title used
function title_used(object $pdo, string $title)
{
    // check if status exist in db
    if (search_title($pdo, $title)) {
        return true;
    } else {
        return false;
    }
    
}