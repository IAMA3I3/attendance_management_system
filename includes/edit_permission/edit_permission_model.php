<?php

declare(strict_types=1);

// fetch site option from db
function fetch_permission_option(object $pdo, $permission_option_id)
{
    $query = "SELECT * FROM permission_options WHERE id = :id;";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $permission_option_id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}