<?php

declare(strict_types=1);

// check for site name in db
function search_site_name(object $pdo, string $site_name)
{
    $query = "SELECT site_name FROM site_options WHERE site_name = :site_name;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":site_name", $site_name);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

// add_site
function add_site(object $pdo, string $site_name, string $description, string $location, $longitude, $latitude)
{
    $query = "INSERT INTO site_options (site_name, description, location, longitude, latitude) VALUES (:site_name, :description, :location, :longitude, :latitude);";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":site_name", $site_name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":location", $location);
    $stmt->bindParam(":longitude", $longitude);
    $stmt->bindParam(":latitude", $latitude);

    $stmt->execute();
}

// update site
function update_site(object $pdo, int $site_option_id, string $site_name, string $description, string $location, $longitude, $latitude)
{
    $query = "UPDATE site_options SET site_name = :site_name, description = :description, location = :location, longitude = :longitude, latitude = :latitude WHERE id = :id;";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":site_name", $site_name);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":location", $location);
    $stmt->bindParam(":longitude", $longitude);
    $stmt->bindParam(":latitude", $latitude);
    $stmt->bindParam(":id", $site_option_id);

    $stmt->execute();
}