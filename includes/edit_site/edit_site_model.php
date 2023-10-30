<?php

declare(strict_types=1);

// fetch site option from db
function fetch_site_option(object $pdo, int $site_option_id)
{
    $query = "SELECT * FROM site_options WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $site_option_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}