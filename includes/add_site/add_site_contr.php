<?php

declare(strict_types=1);

// empty inputs
function empty_input(string $site_name, string $description, string $location, $longitude, $latitude)
{
    if (empty($site_name) || empty($description) || empty($location) || empty($longitude) || empty($latitude)) {
        return true;
    } else {
        return false;
    }
    
}

// site name exist
function site_name_taken(object $pdo, string $site_name)
{
    // check for site name in db
    if (search_site_name($pdo, $site_name)) {
        return true;
    } else {
        return false;
    }
    
}